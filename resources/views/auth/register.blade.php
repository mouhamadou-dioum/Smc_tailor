@extends('layouts.master')

@section('title', 'Inscription - Couture App')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="text-center mb-4">
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
                            <label class="form-label-custom">Mot de passe *</label>
                            <input type="password" name="motDePasse" class="form-control form-control-custom" required minlength="6">
                            @error('motDePasse')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label-custom">Confirmer le mot de passe *</label>
                            <input type="password" name="motDePasse_confirmation" class="form-control form-control-custom" required>
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
</section>
@endsection

@section('scripts')
<script>
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