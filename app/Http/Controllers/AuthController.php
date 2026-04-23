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
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
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
            'nom'      => ['required', 'string', 'max:100', 'regex:/^[\pL\s\-]+$/u'],
            'prenom'   => ['nullable', 'string', 'max:100', 'regex:/^[\pL\s\-]*$/u'],
            'email'    => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:clients,email'],
            'telephone'=> ['required', 'string', 'max:20', 'regex:/^\+?[0-9\s\-]{7,20}$/'],
            'motDePasse' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->mixedCase()->numbers(),
            ],
        ]);

        $client = Client::create([
            'nom'             => strip_tags(trim($request->nom)),
            'prenom'          => strip_tags(trim($request->prenom ?? '')),
            'email'           => strtolower(trim($request->email)),
            'telephone'       => trim($request->telephone),
            'motDePasse'      => Hash::make($request->motDePasse),
            'dateInscription' => now(),
        ]);

        // Régénérer la session AVANT la connexion (prévention session fixation)
        $request->session()->regenerate();
        Auth::guard('client')->login($client);

        return redirect()->route('home')->with('success', 'Compte créé avec succès !');
    }

    // ────────────────────────────────────────────────────────────
    //  Connexion (client uniquement — admin utilise /admin/login)
    // ────────────────────────────────────────────────────────────

    public function login(Request $request)
    {
        $request->validate([
            'email'      => ['required', 'string', 'email'],
            'motDePasse' => ['required', 'string'],
        ]);

        // --- Rate limiting (5 essais / 60 s par IP+email) ---
        $throttleKey = 'login|' . Str::lower($request->email) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'email' => "Trop de tentatives. Réessayez dans {$seconds} secondes.",
            ])->withInput($request->only('email'));
        }

        $email    = strtolower(trim($request->email));
        $password = $request->motDePasse;

        // Recherche client uniquement
        $client = Client::where('email', $email)->first();

        if ($client && Hash::check($password, $client->motDePasse)) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();
            Auth::guard('client')->login($client, (bool) $request->remember);
            return redirect()->intended(route('home'))->with('success', 'Connexion réussie !');
        }

        // Incrémenter le compteur même en cas d'email inexistant (protection énumération)
        RateLimiter::hit($throttleKey, 60);

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ])->withInput($request->only('email'));
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
}