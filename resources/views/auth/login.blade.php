@extends('layouts.master')

@section('title', 'Connexion - Couture App')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="text-center mb-4">
                    <h2 class="section-title">Connexion</h2>
                    <p class="section-subtitle">Accédez à votre compte</p>
                </div>
                <div class="form-custom">
                    <form id="loginForm" method="POST" action="{{ route('login') }}">
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
                            <input type="password" name="motDePasse" class="form-control form-control-custom" required>
                            @error('motDePasse')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Se souvenir de moi</label>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100 mb-3">Se connecter</button>
                        <p class="text-center mb-0">
                            Pas de compte? <a href="{{ route('register') }}" style="color: var(--primary);">S'inscrire</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection