@extends('layouts.master')

@section('title', 'Admin - Modifier le vêtement')

@section('content')
<div class="py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Modifier le vêtement</h2>
            <a href="{{ route('admin.vetements.index') }}" class="btn btn-outline-custom">
                <i class="fas fa-arrow-left me-2"></i> Retour
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-custom">
                    <form method="POST" action="{{ route('admin.vetements.update', $vetement->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Nom du vêtement *</label>
                            <input type="text" name="nom" class="form-control form-control-custom" 
                                   value="{{ $vetement->nom }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Description</label>
                            <textarea name="description" class="form-control form-control-custom" rows="4">{{ $vetement->description }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Prix (CFA) *</label>
                                <input type="number" name="prix" class="form-control form-control-custom" 
                                       value="{{ $vetement->prix }}" required min="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Catégorie</label>
                                <select name="categorie_id" class="form-control form-control-custom">
                                    <option value="">Aucune catégorie</option>
                                    @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}" {{ $vetement->categorie_id == $categorie->id ? 'selected' : '' }}>
                                            {{ $categorie->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">URL de l'image</label>
                            <input type="url" name="imageUrl" class="form-control form-control-custom" 
                                   value="{{ $vetement->imageUrl }}">
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="disponible" id="disponible" 
                                       {{ $vetement->disponible ? 'checked' : '' }}>
                                <label class="form-check-label" for="disponible">
                                    Disponible à la réservation
                                </label>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="fas fa-save me-2"></i> Mettre à jour
                            </button>
                            <a href="{{ route('admin.vetements.index') }}" class="btn btn-outline-custom">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection