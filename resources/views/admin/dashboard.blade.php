@extends('layouts.master')

@section('title', 'Admin - Tableau de bord')

@section('content')
<div class="py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Tableau de bord Admin</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-custom btn-sm">
                    <i class="fas fa-tags me-1"></i> Catégories
                </a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Déconnexion</button>
                </form>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card-custom p-4 text-center">
                    <i class="fas fa-tshirt" style="font-size: 2rem; color: var(--primary);"></i>
                    <h3 class="mt-2">{{ $stats['vetements'] }}</h3>
                    <p class="text-muted mb-0">Vêtements</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-custom p-4 text-center">
                    <i class="fas fa-users" style="font-size: 2rem; color: var(--primary);"></i>
                    <h3 class="mt-2">{{ $stats['clients'] }}</h3>
                    <p class="text-muted mb-0">Clients</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-custom p-4 text-center">
                    <i class="fas fa-calendar-alt" style="font-size: 2rem; color: var(--primary);"></i>
                    <h3 class="mt-2">{{ $stats['rendezVous'] }}</h3>
                    <p class="text-muted mb-0">Rendez-vous</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-custom p-4 text-center">
                    <i class="fas fa-clock" style="font-size: 2rem; color: #ffc107;"></i>
                    <h3 class="mt-2">{{ $stats['enAttente'] }}</h3>
                    <p class="text-muted mb-0">En attente</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card-custom p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Derniers vêtements</h4>
                        <a href="{{ route('admin.vetements.index') }}" class="btn btn-outline-custom btn-sm">Voir tout</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prix</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vetements->take(5) as $vetement)
                                <tr>
                                    <td>{{ $vetement->nom }}</td>
                                    <td>{{ number_format($vetement->prix, 0, ',', ' ') }} CFA</td>
                                    <td>
                                        @if($vetement->disponible)
                                            <span class="badge bg-success">Disponible</span>
                                        @else
                                            <span class="badge bg-secondary">Indisponible</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card-custom p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Rendez-vous récents</h4>
                        <a href="{{ route('admin.rendezvous.index') }}" class="btn btn-outline-custom btn-sm">Voir tout</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rendezVous->take(5) as $rdv)
                                <tr>
                                    <td>{{ $rdv->client->nom }}</td>
                                    <td>{{ $rdv->dateRendezVous->format('d/m/Y') }}</td>
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
                                        <a href="{{ route('admin.rendezvous.show', $rdv->id) }}" class="btn btn-sm btn-primary-custom">Voir</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection