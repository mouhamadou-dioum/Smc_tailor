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

        <div class="row">
            <div class="col-lg-6">
                <div class="card-custom p-4 mb-4">
                    <h4 class="mb-3">Informations</h4>
                    <div class="mb-3">
                        <strong>Client:</strong>
                        <p class="mb-0">{{ $rendezVous->client->nom }} {{ $rendezVous->client->prenom }}</p>
                        <small class="text-muted">{{ $rendezVous->client->email }}</small>
                    </div>
                    <div class="mb-3">
                        <strong>Téléphone:</strong>
                        <p class="mb-0">{{ $rendezVous->client->telephone }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Vêtement:</strong>
                        <p class="mb-0">{{ $rendezVous->vetement->nom ?? 'Aucun sélectionné' }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Date:</strong>
                        <p class="mb-0">{{ $rendezVous->dateRendezVous->format('d/m/Y') }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Heure:</strong>
                        <p class="mb-0">{{ $rendezVous->heure }}</p>
                    </div>
                    <div class="mb-0">
                        <strong>Statut:</strong>
                        <p class="mb-0">
                            @if($rendezVous->statut === 'EN_ATTENTE')
                                <span class="badge badge-waiting">En attente</span>
                            @elseif($rendezVous->statut === 'CONFIRME')
                                <span class="badge badge-confirmed">Confirmé</span>
                            @else
                                <span class="badge badge-rejected">Refusé</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card-custom p-4 mb-4">
                    <h4 class="mb-3">Commentaire</h4>
                    <p>{{ $rendezVous->commentaire ?: 'Aucun commentaire' }}</p>
                </div>

                @if($rendezVous->statut === 'EN_ATTENTE')
                <div class="card-custom p-4">
                    <h4 class="mb-3">Actions</h4>
                    <div class="d-flex gap-3">
                        <a href="{{ route('admin.rendezvous.confirmer', $rendezVous->id) }}" 
                           class="btn btn-success flex-grow-1">
                            <i class="fas fa-check me-2"></i> Confirmer
                        </a>
                        <a href="{{ route('admin.rendezvous.refuser', $rendezVous->id) }}" 
                           class="btn btn-danger flex-grow-1">
                            <i class="fas fa-times me-2"></i> Refuser
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection