@extends('layouts.app')

@section('title', 'Admin - Détails du Rendez-vous')

@section('content')
<div class="py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Détails du Rendez-vous</h2>
            <a href="{{ route('admin.rendezvous.index') }}" class="btn btn-outline-custom">
                <i class="fas fa-arrow-left me-2"></i> Retour
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success mb-4">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        @php
            $rawPhone = $rendezVous->client->telephone ?? '';
            $phone = preg_replace('/\D/', '', $rawPhone);
            if ($phone && !str_starts_with($phone, '221')) {
                $phone = '221' . ltrim($phone, '0');
            }
            $vetNom = $rendezVous->vetement?->nom ?? 'votre commande';
            $waDiscuss = urlencode(
                "Bonjour {$rendezVous->client->prenom}, je vous contacte concernant votre rendez-vous du {$rendezVous->dateRendezVous->format('d/m/Y')} à {$rendezVous->heure} pour {$vetNom}."
            );

            // Historique des notifications WhatsApp pour ce RDV
            $waNotifs = $rendezVous->notifications
                ->where('type', 'WHATSAPP')
                ->sortByDesc('dateEnvoi');
            $lastWa = $waNotifs->first();
        @endphp

        <div class="row">
            {{-- Colonne gauche --}}
            <div class="col-lg-6">
                <div class="card-custom p-4 mb-4">
                    <h4 class="mb-3">Client</h4>
                    <div class="mb-2">
                        <strong>Nom :</strong>
                        <span>{{ $rendezVous->client->prenom }} {{ $rendezVous->client->nom }}</span>
                    </div>
                    <div class="mb-2">
                        <strong>Email :</strong>
                        <span>{{ $rendezVous->client->email }}</span>
                    </div>
                    <div class="mb-0">
                        <strong>Téléphone :</strong>
                        <span>{{ $rendezVous->client->telephone ?? 'Non renseigné' }}</span>
                        @if($phone)
                            <a href="https://wa.me/{{ $phone }}" target="_blank"
                               class="btn btn-sm btn-success ms-2">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                        @endif
                    </div>
                </div>

                <div class="card-custom p-4 mb-4">
                    <h4 class="mb-3">Rendez-vous</h4>
                    <div class="mb-2">
                        <strong>Vêtement :</strong>
                        @if($rendezVous->vetement)
                            {{ $rendezVous->vetement->nom }}
                            @if($rendezVous->vetement->prix)
                                <span class="text-muted">({{ number_format($rendezVous->vetement->prix, 0, ',', ' ') }} CFA)</span>
                            @endif
                        @else
                            <span class="text-muted fst-italic">Aucun — à définir lors du RDV</span>
                        @endif
                    </div>
                    <div class="mb-2">
                        <strong>Date :</strong> {{ $rendezVous->dateRendezVous->format('d/m/Y') }}
                    </div>
                    <div class="mb-2">
                        <strong>Heure :</strong> {{ $rendezVous->heure }}
                    </div>
                    <div class="mb-2">
                        <strong>Statut :</strong>
                        @if($rendezVous->statut === 'EN_ATTENTE')
                            <span class="badge badge-waiting">⏳ En attente</span>
                        @elseif($rendezVous->statut === 'CONFIRME')
                            <span class="badge badge-confirmed">✅ Confirmé</span>
                        @else
                            <span class="badge badge-rejected">❌ Refusé</span>
                        @endif
                    </div>
                    @if($rendezVous->commentaire)
                    <div class="mt-3 p-3 rounded" style="background: var(--gray-100);">
                        <strong>Note du client :</strong>
                        <p class="mb-0 mt-1">{{ $rendezVous->commentaire }}</p>
                    </div>
                    @endif
                </div>

                {{-- Historique WhatsApp --}}
                <div class="card-custom p-4">
                    <h4 class="mb-3">
                        <i class="fab fa-whatsapp text-success me-2"></i>Statut WhatsApp
                    </h4>
                    @if($waNotifs->isEmpty())
                        <p class="text-muted mb-0">Aucun message WhatsApp envoyé pour ce RDV.</p>
                    @else
                        <div class="d-flex flex-column gap-2">
                            @foreach($waNotifs as $notif)
                            <div class="d-flex justify-content-between align-items-start p-2 rounded border">
                                <div>
                                    @if($notif->statut === 'ENVOYE')
                                        <span class="badge bg-success mb-1">
                                            <i class="fab fa-whatsapp me-1"></i>Envoyé
                                        </span>
                                    @else
                                        <span class="badge bg-danger mb-1">
                                            <i class="fas fa-exclamation-triangle me-1"></i>Échec
                                        </span>
                                    @endif
                                    <br>
                                    <small class="text-muted">{{ Str::limit($notif->contenu, 60) }}</small>
                                </div>
                                <small class="text-muted text-nowrap ms-2">
                                    {{ $notif->dateEnvoi->format('d/m H:i') }}<br>
                                    {{ $notif->dateEnvoi->diffForHumans() }}
                                </small>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- Colonne droite : actions --}}
            <div class="col-lg-6">

                @if($rendezVous->statut === 'EN_ATTENTE')

                {{-- Étape 1 : Discuter --}}
                <div class="card-custom p-4 mb-4">
                    <h4 class="mb-1">
                        <span class="badge bg-secondary me-2">1</span>
                        Discuter avec le client
                    </h4>
                    <p class="text-muted small mb-3">
                        Contactez le client sur WhatsApp pour confirmer les détails avant de valider.
                    </p>
                    @if($phone)
                        <a href="https://wa.me/{{ $phone }}?text={{ $waDiscuss }}"
                           target="_blank"
                           class="btn btn-success w-100">
                            <i class="fab fa-whatsapp me-2"></i> Ouvrir la conversation WhatsApp
                        </a>
                    @else
                        <p class="text-danger small mb-0">
                            <i class="fas fa-exclamation-circle me-1"></i>
                            Numéro de téléphone non renseigné pour ce client.
                        </p>
                    @endif
                </div>

                {{-- Étape 2 : Décider --}}
                <div class="card-custom p-4">
                    <h4 class="mb-1">
                        <span class="badge bg-secondary me-2">2</span>
                        Valider ou refuser
                    </h4>
                    <p class="text-muted small mb-3">
                        <i class="fab fa-whatsapp text-success me-1"></i>
                        Un message WhatsApp sera automatiquement envoyé au client.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('admin.rendezvous.confirmer', $rendezVous->id) }}"
                           class="btn btn-success flex-grow-1"
                           onclick="return confirm('Confirmer ce rendez-vous ? Un WhatsApp de confirmation sera envoyé au client.')">
                            <i class="fas fa-check me-2"></i>Confirmer
                        </a>
                        <a href="{{ route('admin.rendezvous.refuser', $rendezVous->id) }}"
                           class="btn btn-danger flex-grow-1"
                           onclick="return confirm('Refuser ce rendez-vous ? Un WhatsApp sera envoyé au client.')">
                            <i class="fas fa-times me-2"></i>Refuser
                        </a>
                    </div>
                </div>

                @elseif($rendezVous->statut === 'CONFIRME')

                <div class="card-custom p-4 mb-4">
                    <div class="alert alert-success mb-3">
                        <i class="fab fa-whatsapp me-2"></i>
                        RDV confirmé — un WhatsApp a été envoyé au client.
                    </div>
                    <div class="d-flex gap-3">
                        <a href="{{ route('admin.mesures.create', $rendezVous->client_id) }}"
                           class="btn btn-primary-custom flex-grow-1">
                            <i class="fas fa-ruler me-2"></i>Prendre les mesures
                        </a>
                        <a href="{{ route('admin.mesures.historique', $rendezVous->client_id) }}"
                           class="btn btn-outline-custom flex-grow-1">
                            <i class="fas fa-history me-2"></i>Historique
                        </a>
                    </div>
                </div>

                @else

                <div class="card-custom p-4">
                    <div class="alert alert-danger mb-0">
                        <i class="fab fa-whatsapp me-2"></i>
                        RDV refusé — un WhatsApp d'information a été envoyé au client.
                    </div>
                </div>

                @endif

            </div>
        </div>
    </div>
</div>
@endsection