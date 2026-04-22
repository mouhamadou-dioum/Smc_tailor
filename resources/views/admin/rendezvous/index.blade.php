@extends('layouts.master')

@section('title', 'Admin - Rendez-vous')

@section('content')
<div class="py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestion des Rendez-vous</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-custom alert-success-custom mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="card-custom">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: var(--gray-100);">
                        <tr>
                            <th>Client</th>
                            <th>Vêtement</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rendezVous as $rdv)
                        <tr>
                            <td>
                                <strong>{{ $rdv->client->nom }}</strong><br>
                                <small class="text-muted">{{ $rdv->client->email }}</small>
                            </td>
                            <td>{{ $rdv->vetement->nom ?? 'Aucun' }}</td>
                            <td>{{ $rdv->dateRendezVous->format('d/m/Y') }}</td>
                            <td>{{ $rdv->heure }}</td>
                            <td>
                                @if($rdv->statut === 'EN_ATTENTE')
                                    <span class="badge badge-waiting">En attente</span>
                                @elseif($rdv->statut === 'CONFIRME')
                                    <span class="badge badge-confirmed">Confirmé</span>
                                @else
                                    <span class="badge badge-rejected">Refusé</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.rendezvous.show', $rdv->id) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($rdv->statut === 'EN_ATTENTE')
                                        <a href="{{ route('admin.rendezvous.confirmer', $rdv->id) }}" 
                                           class="btn btn-sm btn-outline-success" title="Confirmer">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <a href="{{ route('admin.rendezvous.refuser', $rdv->id) }}" 
                                           class="btn btn-sm btn-outline-danger" title="Refuser">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Aucun rendez-vous pour le moment.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection