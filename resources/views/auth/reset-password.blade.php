@extends('layouts.master')

@section('title', 'Réinitialisation du mot de passe - Couture App')

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

    .auth-input[type="password"]::-ms-reveal,
    .auth-input[type="password"]::-ms-clear {
        display: none !important;
    }

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
                    <h1 class="auth-title">Nouveau mot de passe</h1>
                    <p class="auth-subtitle">Saisissez les informations de réinitialisation</p>
                </div>
                
                <div class="auth-card">
                    @if($errors->any())
                        <div class="alert alert-danger" style="background:#f8d7da; border-color:#f5c2c7; color:#842029; border-radius:8px; padding:0.85rem; font-size:0.875rem; margin-bottom:1.5rem;">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            <label class="auth-label">Adresse e-mail *</label>
                            <input type="email" name="email" class="auth-input" required readonly placeholder="votre@email.com" value="{{ old('email', $email) }}">
                        </div>

                        <div class="mb-3">
                            <label class="auth-label">Nouveau mot de passe *</label>
                            <div class="position-relative">
                                <input
                                    type="password"
                                    id="motDePasse"
                                    name="motDePasse"
                                    class="auth-input"
                                    required
                                    style="padding-right:45px;"
                                    placeholder="••••••••"
                                >
                                <button
                                    type="button"
                                    class="password-toggle position-absolute"
                                    onclick="togglePassword('motDePasse', 'toggleIcon1')"
                                    style="right:2px;top:50%;transform:translateY(-50%);border:none;background:transparent;"
                                    aria-label="Afficher / masquer"
                                >
                                    <i class="fas fa-eye" id="toggleIcon1"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="auth-label">Confirmer le mot de passe *</label>
                            <div class="position-relative">
                                <input
                                    type="password"
                                    id="motDePasse_confirmation"
                                    name="motDePasse_confirmation"
                                    class="auth-input"
                                    required
                                    style="padding-right:45px;"
                                    placeholder="••••••••"
                                >
                                <button
                                    type="button"
                                    class="password-toggle position-absolute"
                                    onclick="togglePassword('motDePasse_confirmation', 'toggleIcon2')"
                                    style="right:2px;top:50%;transform:translateY(-50%);border:none;background:transparent;"
                                    aria-label="Afficher / masquer"
                                >
                                    <i class="fas fa-eye" id="toggleIcon2"></i>
                                </button>
                            </div>
                        </div>
                        
                        <button type="submit" class="auth-btn mb-3">Réinitialiser le mot de passe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon  = document.getElementById(iconId);

    if (input.type === 'password') {
        input.type     = 'text';
        icon.className = 'fas fa-eye-slash';
    } else {
        input.type     = 'password';
        icon.className = 'fas fa-eye';
    }
}
</script>
@endsection
