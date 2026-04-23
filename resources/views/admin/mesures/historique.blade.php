@extends('layouts.master')

@section('title', 'Historique des mesures - ' . ($client->nom ?? 'Client'))

@section('content')
<div class="py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Historique des mesures</h2>
            <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-custom">
                <i class="fas fa-arrow-left me-2"></i> Retour aux clients
            </a>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-custom">
                    <div class="mb-4 p-3 bg-light rounded">
                        <strong>Client:</strong> {{ $client->nom }} {{ $client->prenom }}<br>
                        <strong>Téléphone:</strong> {{ $client->telephone }}<br>
                        <strong>Email:</strong> {{ $client->email }}
                    </div>

                    @if($mesures->isEmpty())
                        <div class="alert alert-custom alert-info-custom">
                            Aucune mesure enregistrée pour ce client.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Nom tenue</th>
                                        <th>Cou</th>
                                        <th>Épaule</th>
                                        <th>Manche</th>
                                        <th>Hanche</th>
                                        <th>Tour bras</th>
                                        <th>Cuisse</th>
                                        <th>L. Chemise</th>
                                        <th>L. Boubou</th>
                                        <th>L. Pantalon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mesures as $mesure)
                                        <tr>
                                            <td>{{ $mesure->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $mesure->nom ?? '-' }}</td>
                                            <td>{{ $mesure->cou ?? '-' }}</td>
                                            <td>{{ $mesure->epaule ?? '-' }}</td>
                                            <td>{{ $mesure->manche ?? '-' }}</td>
                                            <td>{{ $mesure->hanche ?? '-' }}</td>
                                            <td>{{ $mesure->tourbras ?? '-' }}</td>
                                            <td>{{ $mesure->cuisse ?? '-' }}</td>
                                            <td>{{ $mesure->longueurChemise ?? '-' }}</td>
                                            <td>{{ $mesure->longueurBoubou ?? '-' }}</td>
                                            <td>{{ $mesure->longueurPantalon ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection