@extends('layouts.master')

@section('title', 'Réserver un Rendez-vous - Couture App')

{{--
    =====================================================
    CORRECTIF DESIGN — Formulaire de prise de RDV
    -------------------------------------------------------
    Ce fichier utilisait des classes (form-custom, form-label-custom,
    form-control-custom, btn-primary-custom, alert-custom) qui n'étaient
    définies que dans layouts/app.blade.php et non dans layouts/master.blade.php.
    Résultat : le formulaire était rendu sans style, incohérent avec le reste.

    SOLUTION DOUBLE :
      1. Les classes manquantes ont été ajoutées dans layouts/master.blade.php
         (correctif dans master) pour que toutes les pages qui étendent master
         bénéficient du même design système.
      2. Ce fichier ajoute une section @styles locale avec un en-tête de page
         stylisé (bandeau hero sombre) identique aux autres pages du site.
    =====================================================
--}}

@section('styles')
<style>
    /*
     * En-tête de page — identique au style hero des autres pages
     * (rendezvous/index, vetements/index…)
     */
    .page-header {
        background: linear-gradient(135deg, var(--dark) 0%, #2d2d4a 100%);
        padding: 3.5rem 0 2.5rem;
        margin-bottom: 0;
    }

    .page-header .section-title {
        color: var(--white);
        font-family: 'Playfair Display', serif;
        font-size: 2.25rem;
    }

    .page-header .section-subtitle {
        color: var(--gray-400);
        font-size: 1rem;
        margin-bottom: 0;
    }

    .page-header .section-subtitle a {
        color: var(--primary);
        text-decoration: none;
    }

    .page-header .section-subtitle a:hover {
        text-decoration: underline;
    }

    /* Zone principale du formulaire */
    .rdv-form-section {
        padding: 3rem 0 4rem;
        background: var(--gray-100);
        min-height: calc(100vh - 280px);
    }

    /* Carte vêtement pré-sélectionné */
    .vetement-preselect-card {
        background: var(--gray-100);
        border: 1.5px solid var(--gray-300) !important;
        border-radius: 10px;
    }

    /* Options radio de notification */
    .notif-option {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1.25rem;
        border: 2px solid var(--gray-300);
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        font-weight: 500;
        color: var(--gray-700);
        user-select: none;
    }

    .notif-option:hover {
        border-color: var(--primary);
        color: var(--primary);
    }

    /* Encart info bleu */
    .info-box {
        background-color: #e8f4fd;
        border-left: 4px solid #3b9ede;
        border-radius: 0 8px 8px 0;
        padding: 0.85rem 1.1rem;
        color: #0c5460;
        font-size: 0.9rem;
    }
</style>
@endsection

{{-- ── En-tête de page ── --}}
@section('content')
<div class="page-header">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title">Réserver un rendez-vous</h2>
            <p class="section-subtitle mt-3">
                @if($vetementPreselect)
                    Vous réservez pour le modèle sélectionné dans la collection.
                @else
                    Rendez-vous général (prise de mesures, conseil, autre demande).<br>
                    Pour un modèle précis, passez par la
                    <a href="{{ route('vetements.index') }}">collection</a> puis « Réserver ».
                @endif
            </p>
        </div>
    </div>
</div>

{{-- ── Formulaire ── --}}
<section class="rdv-form-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">

                {{-- Messages d'erreur globaux (validation Laravel) --}}
                @if($errors->any())
                    <div class="alert alert-danger mb-4 rounded-3">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Veuillez corriger les erreurs ci-dessous.
                    </div>
                @endif

                <div class="form-custom">
                    <form id="rendezvousForm" method="POST" action="{{ route('rendezvous.store') }}">
                        @csrf

                        {{-- Vêtement pré-sélectionné --}}
                        @if($vetementPreselect)
                            <input type="hidden" name="vetement_id" value="{{ $vetementPreselect->id }}">
                            <div class="vetement-preselect-card mb-4 p-3">
                                <div class="d-flex gap-3 align-items-center flex-wrap flex-sm-nowrap">
                                    @php
                                        $_src = $vetementPreselect->imageUrl;
                                        $_src = $_src && !str_starts_with($_src, 'http') ? \Illuminate\Support\Facades\Storage::url($_src) : $_src;
                                    @endphp
                                    @if($_src)
                                        <img
                                            src="{{ $_src }}"
                                            alt="{{ $vetementPreselect->nom }}"
                                            class="rounded"
                                            style="width:72px;height:72px;min-width:72px;object-fit:cover;"
                                        >
                                    @endif
                                    <div class="flex-grow-1">
                                        <label class="form-label-custom mb-1" style="font-size:0.8rem;text-transform:uppercase;letter-spacing:.5px;color:var(--gray-500);">Modèle concerné</label>
                                        <div class="fw-bold" style="color:var(--dark);">{{ $vetementPreselect->nom }}</div>
                                        <span class="text-muted" style="font-size:0.875rem;">{{ number_format($vetementPreselect->prix, 0, ',', ' ') }} CFA</span>
                                    </div>
                                    <a href="{{ route('vetements.index') }}" class="btn btn-outline-custom btn-sm">
                                        <i class="fas fa-exchange-alt me-1"></i> Changer
                                    </a>
                                </div>
                            </div>
                        @endif

                        {{-- Date + Heure --}}
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label-custom" for="dateInput">
                                    <i class="fas fa-calendar me-1 text-muted"></i> Date du rendez-vous *
                                </label>
                                <input
                                    type="date"
                                    name="dateRendezVous"
                                    id="dateInput"
                                    class="form-control form-control-custom @error('dateRendezVous') is-invalid @enderror"
                                    required
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                    value="{{ old('dateRendezVous') }}"
                                >
                                @error('dateRendezVous')
                                    <span class="text-danger small"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label-custom" for="heureSelect">
                                    <i class="fas fa-clock me-1 text-muted"></i> Heure *
                                </label>
                                <select
                                    name="heure"
                                    id="heureSelect"
                                    class="form-select form-control-custom @error('heure') is-invalid @enderror"
                                    required
                                >
                                    <option value="">Sélectionnez l'heure</option>
                                    @foreach(['09:00','10:00','11:00','14:00','15:00','16:00','17:00'] as $h)
                                        <option value="{{ $h }}" {{ old('heure') === $h ? 'selected' : '' }}>{{ $h }}</option>
                                    @endforeach
                                </select>
                                @error('heure')
                                    <span class="text-danger small"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Commentaire / Demande --}}
                        <div class="mb-4">
                            <label class="form-label-custom" for="commentaire">
                                <i class="fas fa-comment me-1 text-muted"></i>
                                @if($vetementPreselect)
                                    Commentaire <span class="text-muted fw-normal">(optionnel)</span>
                                @else
                                    Décrivez votre demande *
                                @endif
                            </label>
                            <textarea
                                name="commentaire"
                                id="commentaire"
                                class="form-control form-control-custom @error('commentaire') is-invalid @enderror"
                                rows="4"
                                placeholder="{{ $vetementPreselect ? 'Précisez vos attentes, mensurations particulières…' : 'Ex. : prise de mesures pour costume, retouches, consultation style…' }}"
                                {{ $vetementPreselect ? '' : 'required' }}
                            >{{ old('commentaire') }}</textarea>
                            @error('commentaire')
                                <span class="text-danger small"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</span>
                            @enderror
                            @if(!$vetementPreselect)
                                <small class="text-muted mt-1 d-block">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Sans modèle lié, merci d'indiquer clairement l'objet du rendez-vous.
                                </small>
                            @endif
                        </div>

                        {{-- Type de notification --}}
                        <div class="mb-4">
                            <label class="form-label-custom">
                                <i class="fas fa-bell me-1 text-muted"></i> Notification préférée *
                            </label>
                            <div class="d-flex gap-3 flex-wrap">
                                <label class="notif-option" id="label-email">
                                    <input
                                        class="form-check-input me-1"
                                        type="radio"
                                        name="typeNotification"
                                        id="notifEmail"
                                        value="EMAIL"
                                        {{ old('typeNotification', 'EMAIL') === 'EMAIL' ? 'checked' : '' }}
                                        onchange="updateNotifStyle(this)"
                                    >
                                    <i class="fas fa-envelope"></i> Email
                                </label>

                                <label class="notif-option" id="label-whatsapp">
                                    <input
                                        class="form-check-input me-1"
                                        type="radio"
                                        name="typeNotification"
                                        id="notifWhatsapp"
                                        value="WHATSAPP"
                                        {{ old('typeNotification') === 'WHATSAPP' ? 'checked' : '' }}
                                        onchange="updateNotifStyle(this)"
                                    >
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </label>
                            </div>
                        </div>

                        {{-- Encart informatif --}}
                        <div class="info-box mb-4">
                            <i class="fas fa-info-circle me-2"></i>
                            Votre demande sera traitée par l'administrateur.
                            Vous recevrez une confirmation par le canal choisi.
                        </div>

                        {{-- Bouton de soumission --}}
                        <button type="submit" class="btn btn-primary-custom w-100" id="submitBtn">
                            <i class="fas fa-paper-plane me-2"></i> Soumettre la demande
                        </button>

                    </form>
                </div><!-- /.form-custom -->

            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
/**
 * Met en surbrillance la carte de notification sélectionnée.
 * @param {HTMLInputElement} radio - le radio button cliqué
 */
function updateNotifStyle(radio) {
    // Réinitialise toutes les cartes de notification
    document.querySelectorAll('.notif-option').forEach(function(el) {
        el.style.borderColor = '';
        el.style.background  = '';
        el.style.color       = '';
    });
    // Surligne la carte du choix courant avec la couleur primaire
    var label = radio.closest('.notif-option');
    if (label) {
        label.style.borderColor = 'var(--primary)';
        label.style.background  = 'rgba(201,169,89,0.07)';
        label.style.color       = 'var(--primary)';
    }
}

document.addEventListener('DOMContentLoaded', function () {

    /* ── Date minimum = demain ── */
    var dateInput = document.getElementById('dateInput');
    var tomorrow  = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    dateInput.min = tomorrow.toISOString().split('T')[0];

    /* ── Initialise le style de la notification cochée par défaut ── */
    var checkedRadio = document.querySelector('input[name="typeNotification"]:checked');
    if (checkedRadio) updateNotifStyle(checkedRadio);

    /* ── Soumission AJAX ── */
    var form      = document.getElementById('rendezvousForm');
    var submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Feedback visuel pendant l'envoi
        submitBtn.disabled  = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Envoi en cours…';

        var formData = new FormData(this);

        fetch(this.action, {
            method:  'POST',
            body:    formData,
            headers: {
                'X-CSRF-TOKEN':     document.querySelector('input[name="_token"]').value,
                'Accept':           'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(async function (response) {
            var data = await response.json().catch(function () { return {}; });

            if (response.ok && data.success) {
                // Succès : on redirige vers la liste des RDV
                alert(data.message || 'Votre demande de rendez-vous a été soumise avec succès !');
                window.location.href = '{{ route("rendezvous.index") }}';
                return;
            }

            if (response.status === 422 && data.errors) {
                // Erreur de validation Laravel : affiche la première erreur
                var first = Object.values(data.errors).flat()[0];
                alert(first || 'Veuillez corriger le formulaire.');
            } else {
                alert(data.message || 'Une erreur est survenue. Veuillez réessayer.');
            }

            // Réactive le bouton en cas d'erreur pour permettre une nouvelle tentative
            submitBtn.disabled  = false;
            submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i> Soumettre la demande';
        })
        .catch(function () {
            alert('Une erreur réseau est survenue. Veuillez réessayer.');
            submitBtn.disabled  = false;
            submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i> Soumettre la demande';
        });
    });

});
</script>
@endsection