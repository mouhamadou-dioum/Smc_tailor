@extends('layouts.master')

@section('title', 'Modifier mon Rendez-vous - Couture App')

@section('styles')
<style>
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

    .rdv-form-section {
        padding: 3rem 0 4rem;
        background: var(--gray-100);
        min-height: calc(100vh - 280px);
    }

    .vetement-preselect-card {
        background: var(--gray-100);
        border: 1.5px solid var(--gray-300) !important;
        border-radius: 10px;
    }

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

    .info-box {
        background-color: #fef3c7;
        border-left: 4px solid #f59e0b;
        border-radius: 0 8px 8px 0;
        padding: 0.85rem 1.1rem;
        color: #92400e;
        font-size: 0.9rem;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title">Modifier votre rendez-vous</h2>
            <p class="section-subtitle mt-3">
                Vous modifiez votre rendez-vous initialement prévu le {{ $rendezVous->dateRendezVous->format('d/m/Y') }} à {{ $rendezVous->heure }}.
            </p>
        </div>
    </div>
</div>

<section class="rdv-form-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">

                @if($errors->any())
                    <div class="alert alert-danger mb-4 rounded-3">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Veuillez corriger les erreurs ci-dessous.
                    </div>
                @endif

                <div class="form-custom">
                    <form id="rendezvousForm" method="POST" action="{{ route('rendezvous.update', $rendezVous->id) }}">
                        @csrf
                        @method('PUT')

                        {{-- Choix du Modèle --}}
                        <div class="mb-4">
                            <label class="form-label-custom" for="vetementSelect">
                                <i class="fas fa-tshirt me-1 text-muted"></i> Modèle de vêtement concerné <span class="text-muted fw-normal">(optionnel)</span>
                            </label>
                            <select
                                name="vetement_id"
                                id="vetementSelect"
                                class="form-select form-control-custom @error('vetement_id') is-invalid @enderror"
                            >
                                <option value="">-- Aucun modèle particulier (conseil ou mesures généraux) --</option>
                                @foreach($vetements as $v)
                                    <option value="{{ $v->id }}" {{ old('vetement_id', $rendezVous->vetement_id) == $v->id ? 'selected' : '' }}>
                                        {{ $v->nom }} ({{ number_format($v->prix, 0, ',', ' ') }} CFA)
                                    </option>
                                @endforeach
                            </select>
                            @error('vetement_id')
                                <span class="text-danger small"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Date + Heure --}}
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label-custom" for="dateInput">
                                    <i class="fas fa-calendar me-1 text-muted"></i> Nouvelle Date *
                                </label>
                                <input
                                    type="date"
                                    name="dateRendezVous"
                                    id="dateInput"
                                    class="form-control form-control-custom @error('dateRendezVous') is-invalid @enderror"
                                    required
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                    value="{{ old('dateRendezVous', $rendezVous->dateRendezVous->format('Y-m-d')) }}"
                                >
                                @error('dateRendezVous')
                                    <span class="text-danger small"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label-custom" for="heureSelect">
                                    <i class="fas fa-clock me-1 text-muted"></i> Heure du RDV *
                                </label>
                                <select
                                    name="heure"
                                    id="heureSelect"
                                    class="form-select form-control-custom @error('heure') is-invalid @enderror"
                                    required
                                >
                                    <option value="">Sélectionnez l'heure</option>
                                    @foreach(['09:00','10:00','11:00','14:00','15:00','16:00','17:00'] as $h)
                                        <option value="{{ $h }}" {{ old('heure', $rendezVous->heure) === $h ? 'selected' : '' }}>{{ $h }}</option>
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
                                Commentaire ou description des retouches *
                            </label>
                            <textarea
                                name="commentaire"
                                id="commentaire"
                                class="form-control form-control-custom @error('commentaire') is-invalid @enderror"
                                rows="4"
                                placeholder="Précisez votre demande, vos mensurations ou vos modifications..."
                                required
                            >{{ old('commentaire', $rendezVous->commentaire) }}</textarea>
                            @error('commentaire')
                                <span class="text-danger small"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        <input type="hidden" name="typeNotification" value="WHATSAPP">

                        {{-- Encart informatif --}}
                        <div class="info-box mb-4">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Note :</strong> Après modification, le statut de votre rendez-vous sera réinitialisé à <strong>En attente de re-confirmation</strong>. L'administrateur sera immédiatement notifié par WhatsApp.
                        </div>

                        {{-- Boutons d'action --}}
                        <div class="d-flex gap-3">
                            <a href="{{ route('rendezvous.index') }}" class="btn btn-outline-custom w-50">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-primary-custom w-50" id="submitBtn">
                                <i class="fas fa-save me-2"></i> Enregistrer
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
function updateNotifStyle(radio) {
    document.querySelectorAll('.notif-option').forEach(function(el) {
        el.style.borderColor = '';
        el.style.background  = '';
        el.style.color       = '';
    });
    var label = radio.closest('.notif-option');
    if (label) {
        label.style.borderColor = 'var(--primary)';
        label.style.background  = 'rgba(201,169,89,0.07)';
        label.style.color       = 'var(--primary)';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    var dateInput = document.getElementById('dateInput');
    var tomorrow  = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    dateInput.min = tomorrow.toISOString().split('T')[0];

    var checkedRadio = document.querySelector('input[name="typeNotification"]:checked');
    if (checkedRadio) updateNotifStyle(checkedRadio);

    /* AJAX Submit */
    var form      = document.getElementById('rendezvousForm');
    var submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        submitBtn.disabled  = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Envoi en cours…';

        var formData = new FormData(this);

        fetch(this.action, {
            method:  'POST', // Utilise fetch avec POST car Laravel simule le PUT via _method
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
                alert(data.message || 'Votre rendez-vous a été modifié avec succès !');
                window.location.href = '{{ route("rendezvous.index") }}';
                return;
            }

            if (response.status === 422 && data.errors) {
                var first = Object.values(data.errors).flat()[0];
                alert(first || 'Veuillez corriger le formulaire.');
            } else {
                alert(data.message || 'Une erreur est survenue. Veuillez réessayer.');
            }

            submitBtn.disabled  = false;
            submitBtn.innerHTML = '<i class="fas fa-save me-2"></i> Enregistrer';
        })
        .catch(function () {
            alert('Une erreur réseau est survenue. Veuillez réessayer.');
            submitBtn.disabled  = false;
            submitBtn.innerHTML = '<i class="fas fa-save me-2"></i> Enregistrer';
        });
    });
});
</script>
@endsection
