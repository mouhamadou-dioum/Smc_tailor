@extends('layouts.master')

@section('title', 'Connexion - Couture App')

@section('styles')
<style>
    .auth-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        padding: 2rem 0;
    }

    .auth-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        width: 100%;
        max-width: 450px;
    }

    .auth-logo {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary) !important;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 0.5rem;
    }

    .auth-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.75rem;
        color: #1a1a2e;
        margin-bottom: 0.5rem;
    }

    .auth-subtitle {
        color: #6c757d;
        font-size: 0.95rem;
        margin-bottom: 2rem;
    }

    .auth-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        display: block;
    }

    .auth-input {
        border: 2px solid #e9ecef;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        width: 100%;
    }

    .auth-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(201,169,89,0.2);
        outline: none;
    }

    .auth-btn {
        background: var(--primary);
        color: white;
        border: none;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s ease;
    }

    .auth-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }

    .auth-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
    }

    .auth-link:hover {
        text-decoration: underline;
    }

    .auth-back {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        font-size: 0.9rem;
    }

    .auth-back:hover {
        color: #fff;
    }

    .password-toggle {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-left: none;
        border-radius: 0 8px 8px 0;
        padding: 0.5rem 0.75rem;
        cursor: pointer;
    }

    .password-toggle:hover {
        background: #e9ecef;
    }

    /* =====================================================
       CORRECTIF #2 — Double icône "œil" sur le champ password
       -------------------------------------------------------
       Chrome, Edge et Safari injectent nativement leur icône
       d'œil sur les champs type="password". On la désactive
       pour ne conserver que l'icône Font Awesome personnalisée.
    ===================================================== */

    /* Masque l'icône native de Edge / IE */
    .auth-input[type="password"]::-ms-reveal,
    .auth-input[type="password"]::-ms-clear {
        display: none !important;
    }

    /* Masque l'icône native de Chrome / Edge Chromium */
    .auth-input[type="password"]::-webkit-credentials-auto-fill-button,
    .auth-input[type="password"]::-webkit-strong-password-auto-fill-button,
    .auth-input[type="password"]::-webkit-contacts-auto-fill-button {
        display: none !important;
        pointer-events: none;
    }
</style>
@endsection

@section('content')
<div class="auth-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="text-center mb-4">
                    <a href="{{ route('home') }}" class="auth-logo">COUTURE</a>
                    <h1 class="auth-title">Connexion</h1>
                    <p class="auth-subtitle">Accédez à votre compte client</p>
                </div>
                
                <div class="auth-card">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="auth-label">Email *</label>
                            <input type="email" name="email" class="auth-input" required placeholder="votre@email.com">
                            @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="auth-label">Mot de passe *</label>
                            <div class="position-relative">
                                {{--
                                    autocomplete="current-password" : indique au navigateur qu'il
                                    s'agit d'un champ de saisie (pas de création), ce qui désactive
                                    l'icône de suggestion de mot de passe fort sur Safari/Firefox
                                    en complément du CSS ci-dessus.
                                --}}
                                <input
                                    type="password"
                                    id="motDePasse"
                                    name="motDePasse"
                                    class="auth-input"
                                    required
                                    autocomplete="current-password"
                                    style="padding-right:45px;"
                                    placeholder="••••••••"
                                >
                                <button
                                    type="button"
                                    class="password-toggle position-absolute"
                                    onclick="togglePassword()"
                                    style="right:2px;top:50%;transform:translateY(-50%);border:none;background:transparent;"
                                    aria-label="Afficher / masquer le mot de passe"
                                >
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                            @error('motDePasse')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="auth-btn mb-3">Se connecter</button>
                    </form>
                    
                    <p class="text-center" style="color:#6c757d;">
                        Pas de compte? <a href="{{ route('register') }}" class="auth-link">S'inscrire</a>
                    </p>
                </div>
                
                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="auth-back">
                        <i class="fas fa-arrow-left me-1"></i> Retour à l'accueil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
{{--
    =====================================================
    CORRECTIF #1 — Navbar positionnée en bas de page
    -------------------------------------------------------
    BUG : @section('scripts') était imbriqué INSIDE @section('content').
    Blade interprète mal les sections imbriquées : le <main> n'était
    pas fermé proprement dans le DOM rendu, ce qui faisait sortir la
    navbar de son flux sticky et la faisait apparaître en bas.

    SOLUTION : on ferme @section('content') ici, puis on ouvre
    @section('scripts') de façon indépendante juste en dessous.
    =====================================================
--}}
@endsection

{{-- ↓ Section scripts SÉPARÉE — jamais imbriquée dans 'content' ↓ --}}
@section('scripts')
<script>
/**
 * togglePassword()
 * Bascule la visibilité du champ mot de passe et met à jour
 * l'icône Font Awesome (œil ouvert / barré).
 */
function togglePassword() {
    const input = document.getElementById('motDePasse');
    const icon  = document.getElementById('toggleIcon');

    if (input.type === 'password') {
        input.type     = 'text';
        icon.className = 'fas fa-eye-slash'; // œil barré = mot de passe visible
    } else {
        input.type     = 'password';
        icon.className = 'fas fa-eye';       // œil ouvert = mot de passe masqué
    }
}
</script>
@endsection