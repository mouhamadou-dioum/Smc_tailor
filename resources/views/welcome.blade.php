@extends('layouts.master')

@section('title', 'Accueil - Couture App')

@section('content')
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="hero-title">L'Art de la Couture Sur Mesure</h1>
                <p class="hero-subtitle">Découvrez nos créations exclusives et réservez votre rendez-vous pour une expérience personnalisée.</p>
                <div class="d-flex gap-3 flex-column flex-sm-row">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-primary-custom" style="padding: 0.4rem 1rem; font-size: 0.85rem;">Commencer</a>
                        <a href="{{ route('login') }}" class="btn btn-outline-custom" style="border-color: white; color: white; padding: 0.4rem 1rem; font-size: 0.85rem;">Connexion</a>
                    @else
                        <a href="{{ route('vetements.index') }}" class="btn btn-primary-custom">Voir les vêtements</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Nos Services</h2>
            <p class="section-subtitle">Ce que nous offrons</p>
        </div>
        <div class="row g-4">
            <div class="col-12 col-md-4">
                <div class="card-custom p-4 text-center">
                    <div class="mb-3">
                        <i class="fas fa-tshirt" style="font-size: 3rem; color: var(--primary);"></i>
                    </div>
                    <h4>Vêtements Sur Mesure</h4>
                    <p class="text-muted">Des pièces uniques adaptées à votre style et vos mesures.</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card-custom p-4 text-center">
                    <div class="mb-3">
                        <i class="fas fa-calendar-check" style="font-size: 3rem; color: var(--primary);"></i>
                    </div>
                    <h4>Réservation en Ligne</h4>
                    <p class="text-muted">Planifiez facilement vos rendez-vous depuis chez vous.</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card-custom p-4 text-center">
                    <div class="mb-3">
                        <i class="fas fa-envelope" style="font-size: 3rem; color: var(--primary);"></i>
                    </div>
                    <h4>Notifications</h4>
                    <p class="text-muted">Recevez vos confirmations par email ou WhatsApp.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background-color: var(--white);">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Comment Ça Marche</h2>
            <p class="section-subtitle">Réservez en quelques étapes simples</p>
        </div>
        <div class="row g-4 text-center">
            <div class="col-6 col-md-3">
                <div class="text-center">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; min-width: 60px; background-color: var(--primary); color: white; font-size: 1.2rem; font-weight: bold;">
                        1
                    </div>
                    <h5 style="font-size: 0.9rem;">Inscrivez-vous</h5>
                    <p class="text-muted" style="font-size: 0.78rem;">Créez votre compte client</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="text-center">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; min-width: 60px; background-color: var(--primary); color: white; font-size: 1.2rem; font-weight: bold;">
                        2
                    </div>
                    <h5 style="font-size: 0.9rem;">Parcourez</h5>
                    <p class="text-muted" style="font-size: 0.78rem;">Découvrez nos créations</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="text-center">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; min-width: 60px; background-color: var(--primary); color: white; font-size: 1.2rem; font-weight: bold;">
                        3
                    </div>
                    <h5 style="font-size: 0.9rem;">Réservez</h5>
                    <p class="text-muted" style="font-size: 0.78rem;">Choisissez un vêtement et date</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="text-center">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; min-width: 60px; background-color: var(--primary); color: white; font-size: 1.2rem; font-weight: bold;">
                        4
                    </div>
                    <h5 style="font-size: 0.9rem;">Confirmez</h5>
                    <p class="text-muted" style="font-size: 0.78rem;">Recevez la confirmation</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Contactez-Nous</h2>
            <p class="section-subtitle">Nous sommes là pour vous</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card-custom p-4">
                    <form id="contactForm">
                        <div class="mb-3">
                            <label class="form-label-custom">Nom</label>
                            <input type="text" class="form-control form-control-custom" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Email</label>
                            <input type="email" class="form-control form-control-custom" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Message</label>
                            <textarea class="form-control form-control-custom" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
document.getElementById('contactForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Merci pour votre message! Nous vous contacterons bientôt.');
    this.reset();
});
</script>
@endsection