@extends('layouts.master')

@section('title', 'Prendre les mesures - ' . ($client->nom ?? 'Client'))

@section('content')
<div class="py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Prendre les mesures</h2>
            <a href="{{ route('admin.rendezvous.index') }}" class="btn btn-outline-custom">
                <i class="fas fa-arrow-left me-2"></i> Retour aux rendez-vous
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-custom">
                    @if($errors->any())
                        <div class="alert alert-custom alert-error-custom mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-4 p-3 bg-light rounded">
                        <strong>Client:</strong> {{ $client->nom }} {{ $client->prenom }}<br>
                        <strong>Téléphone:</strong> {{ $client->telephone }}<br>
                        <strong>Email:</strong> {{ $client->email }}
                    </div>

                    @if($mesure)
                        <div class="alert alert-custom alert-info-custom mb-4">
                            <strong>Dernière mesure:</strong> {{ $mesure->created_at->format('d/m/Y') }}
                            <a href="{{ route('admin.mesures.historique', $client->id) }}" class="btn btn-sm btn-outline-custom ms-2">
                                Voir l'historique
                            </a>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.mesures.store', $client->id) }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Nom de la tenue (optionnel)</label>
                            <input type="text" name="nom" class="form-control form-control-custom" 
                                   placeholder="Ex: Costume mariage, Boubou femme..." value="{{ old('nom') }}">
                        </div>

                        <h5 class="mb-3 mt-4">Mensurations (en cm)</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Cou</label>
                                <input type="number" step="0.1" name="cou" class="form-control form-control-custom" 
                                       placeholder="Ex: 40" value="{{ old('cou', $mesure->cou ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Épaule</label>
                                <input type="number" step="0.1" name="epaule" class="form-control form-control-custom" 
                                       placeholder="Ex: 45" value="{{ old('epaule', $mesure->epaule ?? '') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Manche</label>
                                <input type="number" step="0.1" name="manche" class="form-control form-control-custom" 
                                       placeholder="Ex: 60" value="{{ old('manche', $mesure->manche ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Hanche</label>
                                <input type="number" step="0.1" name="hanche" class="form-control form-control-custom" 
                                       placeholder="Ex: 100" value="{{ old('hanche', $mesure->hanche ?? '') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Tour de bras</label>
                                <input type="number" step="0.1" name="tourbras" class="form-control form-control-custom" 
                                       placeholder="Ex: 30" value="{{ old('tourbras', $mesure->tourbras ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Cuisse</label>
                                <input type="number" step="0.1" name="cuisse" class="form-control form-control-custom" 
                                       placeholder="Ex: 55" value="{{ old('cuisse', $mesure->cuisse ?? '') }}">
                            </div>
                        </div>

                        <h5 class="mb-3 mt-4">Longueurs</h5>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label-custom">Longueur Chemise</label>
                                <input type="number" step="0.1" name="longueurChemise" class="form-control form-control-custom" 
                                       placeholder="Ex: 75" value="{{ old('longueurChemise', $mesure->longueurChemise ?? '') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label-custom">Longueur Boubou</label>
                                <input type="number" step="0.1" name="longueurBoubou" class="form-control form-control-custom" 
                                       placeholder="Ex: 120" value="{{ old('longueurBoubou', $mesure->longueurBoubou ?? '') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label-custom">Longueur Pantalon</label>
                                <input type="number" step="0.1" name="longueurPantalon" class="form-control form-control-custom" 
                                       placeholder="Ex: 100" value="{{ old('longueurPantalon', $mesure->longueurPantalon ?? '') }}">
                            </div>
                        </div>

                        <div class="d-flex gap-3 mt-4">
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="fas fa-save me-2"></i> Enregistrer les mesures
                            </button>
                            <a href="{{ route('admin.rendezvous.index') }}" class="btn btn-outline-custom">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection