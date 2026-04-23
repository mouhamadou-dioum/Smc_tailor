<?php
/**
 * Contrôleur d'authentification
 * Gère la connexion/déconnexion des clients et administrateurs
 * 
 * Les clients sont dans la table 'clients'
 * Les administrateurs sont dans la table 'admins'
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;
use App\Models\Admin;

class AuthController extends Controller
{
    /**
     * Affiche le formulaire de connexion (pour client et admin)
     * Route: GET /login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Affiche le formulaire d'inscription (pour les clients)
     * Route: GET /register
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Inscription d'un nouveau client
     * Route: POST /register
     * 
     * @param Request $request Les données du formulaire
     * @return Redirect Vers la page d'accueil
     */
    public function register(Request $request)
    {
        // Validation des champs
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients,email',
            'telephone' => 'required|string|max:20',
            'motDePasse' => 'required|string|min:6|confirmed', // confirmed = doit avoir motDePasse_confirmation
        ]);

        // Création du client
        $client = Client::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'motDePasse' => bcrypt($request->motDePasse), // Hashage du mot de passe
            'dateInscription' => now(),
        ]);

        // Connexion automatique après inscription
        Auth::guard('client')->login($client);

        // Redirection vers la page d'accueil (même pour admin et client)
        return redirect()->route('home')->with('success', 'Compte créé avec succès!');
    }

    /**
     * Connexion - Vérifie dans clients OU admins
     * Route: POST /login
     * 
     * 1. Cherche d'abord dans la table clients
     * 2. Si pas trouvé, cherche dans la table admins
     * 3. Redirige vers la même page d'accueil pour tous
     * 
     * @param Request $request Les données du formulaire (email, motDePasse)
     * @return Redirect Vers la page d'accueil
     */
    public function login(Request $request)
    {
        // Validation des champs
        $request->validate([
            'email' => 'required|string|email',
            'motDePasse' => 'required|string',
        ]);

        $email = $request->email;
        $password = $request->motDePasse;

        // 1. Cherche d'abord dans la table clients
        $client = Client::where('email', $email)->first();
        
        if ($client && Hash::check($password, $client->motDePasse)) {
            // Connexion du client
            Auth::guard('client')->login($client);
            $request->session()->regenerate();
            // Redirection vers la page d'accueil (même pour client et admin)
            return redirect()->intended(route('home'))->with('success', 'Connexion réussie!');
        }

        // 2. Si pas trouvé dans clients, cherche dans la table admins
        $admin = Admin::where('email', $email)->first();
        
        if ($admin && Hash::check($password, $admin->motDePasse)) {
            // Connexion de l'admin avec le guard 'admin'
            Auth::guard('admin')->login($admin);
            $request->session()->regenerate();
            // Redirection vers le dashboard admin
            return redirect()->intended(route('admin.dashboard'))->with('success', 'Connexion réussie!');
        }

        // Erreur si les identifiants sont incorrects
        return back()->withErrors([
            'email' => 'Les identifiants sont incorrects.',
        ])->withInput();
    }

    /**
     * Déconnexion (pour client et admin)
     * Route: POST /logout
     * 
     * @param Request $request
     * @return Redirect Vers la page d'accueil
     */
    public function logout(Request $request)
    {
        // Déconnexion selon le guard actif
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } else {
            Auth::guard('client')->logout();
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Déconnexion réussie!');
    }
}