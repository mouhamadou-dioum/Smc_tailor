@extends('layouts.master')

@section('title', 'Admin - Clients')

@section('content')
<div class="py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <h2 class="mb-0"><i class="fas fa-users me-2" style="color: var(--primary);"></i>Clients inscrits</h2>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-custom btn-sm">
                <i class="fas fa-arrow-left me-2"></i> Tableau de bord
            </a>
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
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Inscription</th>
                            <th>Rendez-vous</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clients as $client)
                            <tr>
                                <td>
                                    <strong>{{ $client->prenom }} {{ $client->nom }}</strong>
                                </td>
                                <td><a href="mailto:{{ $client->email }}">{{ $client->email }}</a></td>
                                <td>{{ $client->telephone }}</td>
                                <td>{{ $client->dateInscription?->format('d/m/Y') ?? '—' }}</td>
                                <td>
                                    <span class="badge bg-secondary">{{ $client->rendezVous->count() }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    Aucun client enregistré pour le moment.
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
