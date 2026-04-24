@extends('layouts.master')

@section('title', 'Inscription - Couture App')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="text-center mb-4">
                    <a href="{{ route('home') }}" class="navbar-brand">COUTURE</a>
                    <h2 class="section-title">Créer un compte</h2>
                    <p class="section-subtitle">Rejoignez-nous</p>
                </div>
                <div class="form-custom">
                    <form id="registerForm" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Nom *</label>
                                <input type="text" name="nom" class="form-control form-control-custom" required>
                                @error('nom')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Prénom</label>
                                <input type="text" name="prenom" class="form-control form-control-custom">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Email *</label>
                            <input type="email" name="email" class="form-control form-control-custom" required>
                            @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Téléphone *</label>
                            <input type="tel" name="telephone" class="form-control form-control-custom" placeholder="+221 77 123 45 67" required>
                            @error('telephone')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Mot de passe * (min 8 caractères)</label>
                            <div class="input-group">
                                <input type="password" id="motDePasse" name="motDePasse" class="form-control form-control-custom" required minlength="8">
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('motDePasse', 'togglePwd1')" id="togglePwd1">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('motDePasse')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label-custom">Confirmer le mot de passe *</label>
                            <div class="input-group">
                                <input type="password" name="motDePasse_confirmation" class="form-control form-control-custom" required>
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('motDePasse_confirmation', 'togglePwd2')" id="togglePwd2">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100 mb-3">S'inscrire</button>
                        <p class="text-center mb-0">
                            Déjà inscrit? <a href="{{ route('login') }}" style="color: var(--primary);">Se connecter</a>
                        </p>
                    </form>
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

document.getElementById('registerForm').addEventListener('submit', function(e) {
    const password = this.querySelector('input[name="motDePasse"]').value;
    const confirmPassword = this.querySelector('input[name="motDePasse_confirmation"]').value;
    
    if (password !== confirmPassword) {
        e.preventDefault();
        alert('Les mots de passe ne correspondent pas!');
    }
});
</script>
@endsection