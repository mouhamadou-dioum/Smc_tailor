@extends('layouts.master')

@section('title', 'Prendre les mesures - ' . ($client->nom ?? 'Client'))

@section('content')
<div class="rdv-page">
    <div class="container">
        {{-- Header --}}
        <div class="rdv-header">
            <div>
                <h2><i class="fas fa-ruler"></i> Prendre les mesures</h2>
                <div class="subtitle">Saisissez les mensurations du client</div>
            </div>
            <a href="{{ route('admin.rendezvous.index') }}" class="btn btn-outline-custom" style="color:#fff;border-color:rgba(255,255,255,0.3);">
                <i class="fas fa-arrow-left me-2"></i> Rendez-vous
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

                    {{-- Client Info Card --}}
                    <div class="rdv-card mb-4" style="grid-template-columns: auto 1fr auto;">
                        <div class="rdv-date-block" style="min-width:50px;padding:0.5rem;">
                            <i class="fas fa-user-circle" style="font-size:2rem;color:var(--primary);"></i>
                        </div>
                        <div class="rdv-info">
                            <div class="rdv-client">{{ $client->nom }} {{ $client->prenom }}</div>
                            <div class="rdv-phone"><i class="fas fa-phone fa-xs me-1"></i>{{ $client->telephone }}</div>
                            <div class="rdv-comment"><i class="fas fa-envelope fa-xs me-1"></i>{{ $client->email }}</div>
                        </div>
                        @if($mesure)
                            <div class="rdv-actions">
                                <a href="{{ route('admin.mesures.historique', $client->id) }}" class="btn-action view" title="Historique">
                                    <i class="fas fa-history"></i>
                                </a>
                            </div>
                        @endif
                    </div>

                    @if($mesure)
                        <div class="alert alert-custom alert-info-custom mb-4">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Dernière mesure:</strong> {{ $mesure->created_at->format('d/m/Y') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.mesures.store', $client->id) }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Nom de la tenue (optionnel)</label>
                            <input type="text" name="nom" class="form-control form-control-custom" 
                                   placeholder="Ex: Costume mariage, Boubou femme..." value="{{ old('nom') }}">
                        </div>

                        <h5 class="mb-3 mt-4" style="font-family:'Playfair Display',serif;">
                            <i class="fas fa-tshirt me-2" style="color:var(--primary);"></i>Mensurations (en cm)
                        </h5>

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

                        <h5 class="mb-3 mt-4" style="font-family:'Playfair Display',serif;">
                            <i class="fas fa-ruler-vertical me-2" style="color:var(--primary);"></i>Longueurs
                        </h5>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label-custom">Chemise</label>
                                <input type="number" step="0.1" name="longueurChemise" class="form-control form-control-custom" 
                                       placeholder="Ex: 75" value="{{ old('longueurChemise', $mesure->longueurChemise ?? '') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label-custom">Boubou</label>
                                <input type="number" step="0.1" name="longueurBoubou" class="form-control form-control-custom" 
                                       placeholder="Ex: 120" value="{{ old('longueurBoubou', $mesure->longueurBoubou ?? '') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label-custom">Pantalon</label>
                                <input type="number" step="0.1" name="longueurPantalon" class="form-control form-control-custom" 
                                       placeholder="Ex: 100" value="{{ old('longueurPantalon', $mesure->longueurPantalon ?? '') }}">
                            </div>
                        </div>

                        <div class="d-flex gap-3 mt-4">
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="fas fa-save me-2"></i> Enregistrer
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