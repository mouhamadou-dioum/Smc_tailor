@extends('layouts.master')

@section('title', 'Connexion - Couture App')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="text-center mb-4">
                    <a href="{{ route('home') }}" class="navbar-brand">COUTURE</a>
                    <h2 class="section-title">Connexion</h2>
                    <p class="section-subtitle">Accédez à votre compte</p>
                </div>
                <div class="form-custom">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label-custom">Email *</label>
                            <input type="email" name="email" class="form-control form-control-custom" required>
                            @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Mot de passe *</label>
                            <div class="input-group">
                                <input type="password" id="motDePasse" name="motDePasse" class="form-control form-control-custom" required>
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('motDePasse', 'togglePwd')" id="togglePwd">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('motDePasse')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100 mb-3">Se connecter</button>
                    </form>
                    <p class="text-center mb-0">
                        Pas de compte? <a href="{{ route('register') }}" style="color: var(--primary);">S'inscrire</a>
                    </p>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('home') }}" class="text-muted">
                        <i class="fas fa-arrow-left me-1"></i> Retour à l'accueil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<style>
.input-group { position: relative; }
.input-group .btn {
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    border: 2px solid var(--gray-200);
    border-left: none;
    border-radius: 0 6px 6px 0;
    z-index: 10;
}
.input-group input { padding-right: 40px; }
</style>
<script>
function togglePassword(inputId, btnId) {
    const input = document.getElementById(inputId);
    const btn = document.getElementById(btnId);
    if (input.type === 'password') {
        input.type = 'text';
        btn.innerHTML = '<i class="fas fa-eye-slash"></i>';
    } else {
        input.type = 'password';
        btn.innerHTML = '<i class="fas fa-eye"></i>';
    }
}
</script>
@endsection