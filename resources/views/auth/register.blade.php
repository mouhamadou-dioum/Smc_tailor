@extends('layouts.master')

@section('title', 'Inscription - Couture App')

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
        max-width: 550px;
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

    .error-text {
        color: #dc3545;
        font-size: 0.8rem;
        margin-top: 0.25rem;
    }

    /* =====================================================
       CORRECTIF #2 — Double icône "œil" sur les inputs password
       -------------------------------------------------------
       Chrome, Edge et Safari affichent nativement leur propre
       icône d'œil sur les champs type="password".
       On la masque ici pour ne garder QUE l'icône Font Awesome
       définie dans le bouton .password-toggle.
    ===================================================== */

    /* Masque l'icône native de Edge / IE (pseudo-élément ms) */
    .auth-input[type="password"]::-ms-reveal,
    .auth-input[type="password"]::-ms-clear {
        display: none !important;
    }

    /* Masque l'icône native de Chrome / Edge Chromium (pseudo-élément webkit) */
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
            <div class="col-lg-6">
                <div class="text-center mb-4">
                    <a href="{{ route('home') }}" class="auth-logo">COUTURE</a>
                    <h1 class="auth-title">Créer un compte</h1>
                    <p class="auth-subtitle">Rejoignez-nous pour bénéficier de nos services</p>
                </div>
                
                <div class="auth-card">
                    <form id="registerForm" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="auth-label">Nom *</label>
                                <input type="text" name="nom" class="auth-input" required placeholder="Votre nom">
                                @error('nom')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="auth-label">Prénom</label>
                                <input type="text" name="prenom" class="auth-input" placeholder="Votre prénom">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="auth-label">Email *</label>
                            <input type="email" name="email" class="auth-input" required placeholder="votre@email.com">
                            @error('email')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="auth-label">Téléphone *</label>
                            <input type="tel" name="telephone" class="auth-input" placeholder="+221 77 123 45 67" required>
                            @error('telephone')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="auth-label">Mot de passe * (min 8 caractères)</label>
                            <div class="position-relative">
                                {{--
                                    autocomplete="new-password" : empêche le navigateur de proposer
                                    le remplissage automatique et désactive certaines icônes natives
                                    sur Safari/Firefox en complément du CSS ci-dessus.
                                --}}
                                <input
                                    type="password"
                                    id="motDePasse"
                                    name="motDePasse"
                                    class="auth-input"
                                    required
                                    minlength="8"
                                    autocomplete="new-password"
                                    style="padding-right:45px;"
                                    placeholder="••••••••"
                                >
                                <button
                                    type="button"
                                    class="password-toggle position-absolute"
                                    onclick="togglePassword('motDePasse', 'togglePwd1Icon')"
                                    style="right:2px;top:50%;transform:translateY(-50%);border:none;background:transparent;"
                                    aria-label="Afficher / masquer le mot de passe"
                                >
                                    <i class="fas fa-eye" id="togglePwd1Icon"></i>
                                </button>
                            </div>
                            @error('motDePasse')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="auth-label">Confirmer le mot de passe *</label>
                            <div class="position-relative">
                                {{-- Même traitement : autocomplete + CSS pour éviter le double œil --}}
                                <input
                                    type="password"
                                    id="motDePasse_confirmation"
                                    name="motDePasse_confirmation"
                                    class="auth-input"
                                    required
                                    autocomplete="new-password"
                                    style="padding-right:45px;"
                                    placeholder="••••••••"
                                >
                                <button
                                    type="button"
                                    class="password-toggle position-absolute"
                                    onclick="togglePassword('motDePasse_confirmation', 'togglePwd2Icon')"
                                    style="right:2px;top:50%;transform:translateY(-50%);border:none;background:transparent;"
                                    aria-label="Afficher / masquer la confirmation du mot de passe"
                                >
                                    <i class="fas fa-eye" id="togglePwd2Icon"></i>
                                </button>
                            </div>
                        </div>
                        
                        <button type="submit" class="auth-btn mb-3">S'inscrire</button>
                        
                        <p class="text-center" style="color:#6c757d;">
                            Déjà inscrit? <a href="{{ route('login') }}" class="auth-link">Se connecter</a>
                        </p>
                    </form>
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
    Blade ne supporte pas les sections imbriquées : ça cassait le DOM,
    la balise <main> n'était pas fermée correctement, ce qui faisait
    descendre la navbar hors de son flux sticky.

    SOLUTION : @endsection de 'content' est fermé ICI, puis
    @section('scripts') est déclaré séparément en dessous.
    =====================================================
--}}
@endsection

{{-- ↓ Section scripts SÉPARÉE — plus jamais imbriquée dans 'content' ↓ --}}
@section('scripts')
<script>
/**
 * togglePassword()
 * Bascule la visibilité d'un champ mot de passe et met à jour
 * l'icône Font Awesome correspondante (œil ouvert / barré).
 *
 * @param {string} inputId  — id du champ <input type="password">
 * @param {string} iconId   — id de l'élément <i> contenant l'icône
 */
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon  = document.getElementById(iconId);

    if (input.type === 'password') {
        input.type      = 'text';
        icon.className  = 'fas fa-eye-slash'; // œil barré = visible
    } else {
        input.type      = 'password';
        icon.className  = 'fas fa-eye';       // œil ouvert = masqué
    }
}

/**
 * Validation côté client avant soumission du formulaire.
 * Vérifie que les deux champs mot de passe correspondent.
 */
document.getElementById('registerForm').addEventListener('submit', function(e) {
    const password        = this.querySelector('input[name="motDePasse"]').value;
    const confirmPassword = this.querySelector('input[name="motDePasse_confirmation"]').value;

    if (password !== confirmPassword) {
        e.preventDefault();
        alert('Les mots de passe ne correspondent pas !');
    }
});
</script>
@endsection