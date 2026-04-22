@extends('layouts.master')

@section('title', 'Réserver un Rendez-vous - Couture App')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Réserver un rendez-vous</h2>
            @if($vetementPreselect)
                <p class="section-subtitle mb-0">Vous réservez pour le modèle sélectionné dans la collection.</p>
            @else
                <p class="section-subtitle mb-0">Rendez-vous général (prise de mesures, conseil, autre demande). Pour un modèle précis, passez par la <a href="{{ route('vetements.index') }}">collection</a> puis « Réserver ».</p>
            @endif
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-custom">
                    <form id="rendezvousForm" method="POST" action="{{ route('rendezvous.store') }}">
                        @csrf

                        @if($vetementPreselect)
                            <input type="hidden" name="vetement_id" value="{{ $vetementPreselect->id }}">
                            <div class="mb-4 p-3 rounded border" style="border-color: var(--gray-300) !important; background: var(--gray-100);">
                                <div class="d-flex gap-3 align-items-center flex-wrap">
                                    @if($vetementPreselect->imageUrl)
                                        <img src="{{ $vetementPreselect->imageUrl }}" alt="" class="rounded" style="width: 72px; height: 72px; object-fit: cover;">
                                    @endif
                                    <div class="flex-grow-1">
                                        <div class="form-label-custom mb-1">Modèle concerné</div>
                                        <strong>{{ $vetementPreselect->nom }}</strong>
                                        <span class="text-muted ms-2">{{ number_format($vetementPreselect->prix, 0, ',', ' ') }} CFA</span>
                                    </div>
                                    <a href="{{ route('vetements.index') }}" class="btn btn-outline-custom btn-sm">Changer de modèle</a>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label-custom">Date du rendez-vous *</label>
                                <input type="date" name="dateRendezVous" id="dateInput" class="form-control form-control-custom" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ old('dateRendezVous') }}">
                                @error('dateRendezVous')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label-custom">Heure *</label>
                                <select name="heure" class="form-select form-control-custom" required>
                                    <option value="">Sélectionnez l'heure</option>
                                    @foreach(['09:00','10:00','11:00','14:00','15:00','16:00','17:00'] as $h)
                                        <option value="{{ $h }}" {{ old('heure') === $h ? 'selected' : '' }}>{{ $h }}</option>
                                    @endforeach
                                </select>
                                @error('heure')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label-custom">
                                @if($vetementPreselect)
                                    Commentaire (optionnel)
                                @else
                                    Décrivez votre demande *
                                @endif
                            </label>
                            <textarea name="commentaire" class="form-control form-control-custom" rows="4" placeholder="{{ $vetementPreselect ? 'Précisez vos attentes...' : 'Ex. : prise de mesures pour costume, retouches, consultation style…' }}" {{ $vetementPreselect ? '' : 'required' }}>{{ old('commentaire') }}</textarea>
                            @error('commentaire')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                            @if(!$vetementPreselect)
                                <small class="text-muted">Sans modèle lié, merci d’indiquer clairement l’objet du rendez-vous.</small>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="form-label-custom">Type de notification préférée *</label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="typeNotification" id="notifEmail" value="EMAIL" {{ old('typeNotification', 'EMAIL') === 'EMAIL' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="notifEmail">
                                        <i class="fas fa-envelope me-1"></i> Email
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="typeNotification" id="notifWhatsapp" value="WHATSAPP" {{ old('typeNotification') === 'WHATSAPP' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="notifWhatsapp">
                                        <i class="fab fa-whatsapp me-1"></i> WhatsApp
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-custom mb-4" style="background-color: #e7f3ff; color: #0c5460;">
                            <i class="fas fa-info-circle me-2"></i>
                            Votre demande sera traitée par l’administrateur. Vous recevrez une confirmation par le canal choisi.
                        </div>

                        <button type="submit" class="btn btn-primary-custom w-100">
                            <i class="fas fa-paper-plane me-2"></i> Soumettre la demande
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('dateInput');
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    dateInput.min = tomorrow.toISOString().split('T')[0];

    const form = document.getElementById('rendezvousForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(async response => {
            const data = await response.json().catch(() => ({}));
            if (response.ok && data.success) {
                alert(data.message || 'Votre demande de rendez-vous a été soumise avec succès!');
                window.location.href = '{{ route("rendezvous.index") }}';
                return;
            }
            if (response.status === 422 && data.errors) {
                const first = Object.values(data.errors).flat()[0];
                alert(first || 'Veuillez corriger le formulaire.');
                return;
            }
            alert(data.message || 'Une erreur est survenue. Veuillez réessayer.');
        })
        .catch(() => {
            alert('Une erreur est survenue. Veuillez réessayer.');
        });
    });
});
</script>
@endsection
