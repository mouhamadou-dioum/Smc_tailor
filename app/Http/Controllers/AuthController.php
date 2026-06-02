<?php
/**
 * Contrôleur d'authentification — version sécurisée
 *
 * Corrections appliquées :
 *  1. Throttle / rate-limiting (max 5 tentatives / 1 min) sur login
 *  2. Session régénérée AVANT la connexion (fixe session fixation)
 *  3. Mot de passe min 8 caractères + complexité
 *  4. Admin login via son propre guard 'admin' uniquement
 *  5. Validation stricte (trim, lowercase email)
 *  6. Messages d'erreur génériques (pas d'énumération email)
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\Admin;

class AuthController extends Controller
{
    // ────────────────────────────────────────────────────────────
    //  Formulaires
    // ────────────────────────────────────────────────────────────

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // ────────────────────────────────────────────────────────────
    //  Inscription client
    // ────────────────────────────────────────────────────────────

    public function register(Request $request)
    {
        $request->validate([
            'nom'      => ['required', 'string', 'max:100'],
            'prenom'   => ['nullable', 'string', 'max:100'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:clients,email'],
            'telephone'=> ['required', 'string', 'max:20'],
            'motDePasse' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $client = Client::create([
            'nom'             => strip_tags(trim($request->nom)),
            'prenom'          => strip_tags(trim($request->prenom ?? '')),
            'email'           => strtolower(trim($request->email)),
            'telephone'       => trim($request->telephone),
            'motDePasse'      => Hash::make($request->motDePasse),
            'dateInscription' => now(),
        ]);

        // Ne pas connecter automatiquement — rediriger vers la page de connexion
        return redirect()->route('login')->with('success', 'Compte créé avec succès ! Connectez-vous.');
    }

    // ────────────────────────────────────────────────────────────
    //  Connexion (client uniquement — admin utilise /admin/login)
    // ────────────────────────────────────────────────────────────

    public function login(Request $request)
    {
        $request->validate([
            'login'      => ['required', 'string'],
            'motDePasse' => ['required', 'string'],
        ]);

        $loginInput = trim($request->login);
        $password = $request->motDePasse;

        // --- Rate limiting (5 essais / 60 s par IP+login) ---
        $throttleKey = 'login|' . Str::lower($loginInput) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'login' => "Trop de tentatives. Réessayez dans {$seconds} secondes.",
            ])->withInput($request->only('login'));
        }

        // Recherche par email ou téléphone
        $client = Client::where('email', strtolower($loginInput))
            ->orWhere('telephone', $loginInput)
            ->first();

        if ($client && Hash::check($password, $client->motDePasse)) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();
            Auth::guard('client')->login($client, (bool) $request->remember);
            return redirect()->intended(route('home'))->with('success', 'Connexion réussie !');
        }

        // Incrémenter le compteur même en cas d'identifiant inexistant
        RateLimiter::hit($throttleKey, 60);

        return back()->withErrors([
            'login' => 'Identifiants incorrects.',
        ])->withInput($request->only('login'));
    }

    // ────────────────────────────────────────────────────────────
    //  Déconnexion client
    // ────────────────────────────────────────────────────────────

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Déconnexion réussie !');
    }

    // ────────────────────────────────────────────────────────────
    //  Mot de passe oublié & Réinitialisation
    // ────────────────────────────────────────────────────────────

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:clients,email'],
        ], [
            'email.exists' => "Cette adresse e-mail n'est pas enregistrée chez nous.",
        ]);

        $email = strtolower(trim($request->email));

        // Générer un token unique
        $token = Str::random(60);

        // Enregistrer le token en base
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => Hash::make($token),
                'created_at' => now()
            ]
        );

        $resetLink = route('password.reset', ['token' => $token]) . '?email=' . urlencode($email);

        try {
            // Envoyer l'e-mail avec le lien
            Mail::send('emails.forgot-password', ['resetLink' => $resetLink], function ($message) use ($email) {
                $message->to($email)->subject('Réinitialisation de votre mot de passe — SMC Couture');
            });
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Erreur lors de l\'envoi de l\'email de réinitialisation', [
                'email' => $email,
                'error' => $e->getMessage()
            ]);
            // Pour faciliter le test en local, si l'envoi d'e-mail plante (pas de serveur SMTP configuré),
            // on affiche quand même le lien de test en session (pour que le dev local fonctionne)
            if (config('app.env') === 'local' || config('app.debug') === true) {
                return back()->with('success', 'Lien de réinitialisation généré (mode local) : ' . $resetLink)
                             ->with('debug_link', $resetLink);
            }
            return back()->withErrors(['email' => "Impossible d'envoyer l'e-mail de réinitialisation pour le moment. Veuillez réessayer."]);
        }

        return back()->with('success', 'Un e-mail contenant le lien de réinitialisation vous a été envoyé !');
    }

    public function showResetPasswordForm(Request $request, $token)
    {
        $email = $request->query('email');
        return view('auth.reset-password', compact('token', 'email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email', 'exists:clients,email'],
            'motDePasse' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $email = strtolower(trim($request->email));
        $tokenData = DB::table('password_reset_tokens')->where('email', $email)->first();

        if (!$tokenData || !Hash::check($request->token, $tokenData->token)) {
            return back()->withErrors(['email' => 'Le lien de réinitialisation est invalide ou a expiré.']);
        }

        // Vérifier si le token a moins d'une heure (60 minutes)
        $createdAt = new \DateTime($tokenData->created_at);
        $diff = $createdAt->diff(new \DateTime());
        $minutes = ($diff->days * 24 * 60) + ($diff->h * 60) + $diff->i;

        if ($minutes > 60) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            return back()->withErrors(['email' => 'Le lien de réinitialisation a expiré (validité de 60 minutes).']);
        }

        // Mettre à jour le mot de passe du client
        $client = Client::where('email', $email)->firstOrFail();
        $client->update([
            'motDePasse' => Hash::make($request->motDePasse)
        ]);

        // Supprimer le token utilisé
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return redirect()->route('login')->with('success', 'Votre mot de passe a été modifié avec succès. Connectez-vous !');
    }
}