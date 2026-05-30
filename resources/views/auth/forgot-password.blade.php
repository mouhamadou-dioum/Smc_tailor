@extends('layouts.master')

@section('title', 'Mot de passe oublié - Couture App')

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
</style>
@endsection

@section('content')
<div class="auth-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="text-center mb-4">
                    <a href="{{ route('home') }}" class="auth-logo">COUTURE</a>
                    <h1 class="auth-title">Mot de passe oublié</h1>
                    <p class="auth-subtitle">Saisissez votre e-mail pour recevoir le lien de réinitialisation</p>
                </div>
                
                <div class="auth-card">
                    @if(session('success'))
                        <div class="alert alert-success" style="background:#d1e7dd; border-color:#badbcc; color:#0f5132; border-radius:8px; padding:0.85rem; font-size:0.875rem; margin-bottom:1.5rem;">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger" style="background:#f8d7da; border-color:#f5c2c7; color:#842029; border-radius:8px; padding:0.85rem; font-size:0.875rem; margin-bottom:1.5rem;">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="auth-label">Email de votre compte *</label>
                            <input type="email" name="email" class="auth-input" required placeholder="votre@email.com" value="{{ old('email') }}">
                        </div>
                        
                        <button type="submit" class="auth-btn mb-3">Envoyer le lien de réinitialisation</button>
                    </form>

                    @if(session('debug_link'))
                        <div class="mt-3" style="background:#e0f2fe; border: 1px solid #bae6fd; color:#0369a1; border-radius:8px; padding:0.85rem; font-size:0.82rem; line-height: 1.4;">
                            <strong style="color:#0284c7;"><i class="fas fa-bug me-1"></i> [Mode Débogage Local]</strong><br>
                            L'envoi d'e-mail a échoué (serveur SMTP non configuré). Cliquez sur le lien ci-dessous pour continuer la réinitialisation :<br>
                            <a href="{{ session('debug_link') }}" style="color:#0284c7; font-weight:700; word-break:break-all; text-decoration: underline; display:block; margin-top:5px;">{{ session('debug_link') }}</a>
                        </div>
                    @endif
                    
                    <p class="text-center mt-3 mb-0" style="color:#6c757d;">
                        Retourner à la <a href="{{ route('login') }}" class="auth-link">Connexion</a>
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
@endsection
