@extends('layouts.master')

@section('title', 'Mes rendez-vous - Couture App')

@section('content')
<div class="py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <h2 class="mb-0"><i class="fas fa-calendar-check me-2" style="color: var(--primary);"></i>Mes rendez-vous</h2>
            <a href="{{ route('rendezvous.create') }}" class="btn btn-primary-custom btn-sm">
                <i class="fas fa-calendar-plus me-2"></i>Nouveau rendez-vous
            </a>
        </div>

        <div class="card-custom">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: var(--gray-100);">
                        <tr>
                            <th>Vêtement</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Statut</th>
                            <th>Commentaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rendezVous as $rdv)
                            <tr>
                                <td><strong>{{ $rdv->vetement?->nom ?? '—' }}</strong></td>
                                <td>{{ $rdv->dateRendezVous?->format('d/m/Y') }}</td>
                                <td>{{ $rdv->heure }}</td>
                                <td>
                                    @if($rdv->statut === \App\Models\RendezVous::STATUT_CONFIRME)
                                        <span class="badge bg-success">Confirmé</span>
                                    @elseif($rdv->statut === \App\Models\RendezVous::STATUT_REFUSE)
                                        <span class="badge bg-danger">Refusé</span>
                                    @else
                                        <span class="badge bg-warning text-dark">En attente</span>
                                    @endif
                                </td>
                                <td class="text-muted small">{{ \Illuminate\Support\Str::limit($rdv->commentaire ?? '—', 60) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-calendar-xmark fa-2x mb-3 d-block opacity-50"></i>
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
