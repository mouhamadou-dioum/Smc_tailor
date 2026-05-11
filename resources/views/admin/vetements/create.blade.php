@extends('layouts.master')

@section('title', 'Admin - Ajouter un vêtement')

@section('styles')
<style>
    .admin-page {
        padding: 1.5rem 0 4rem;
        min-height: 80vh;
        background: var(--gray-100);
    }

    .admin-header {
        background: linear-gradient(135deg, var(--dark) 0%, #2d2d4e 100%);
        border-radius: 20px;
        padding: 2rem 2.5rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        box-shadow: 0 8px 32px rgba(26,26,46,0.18);
    }

    .admin-header h2 {
        color: #fff;
        font-size: 1.7rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .admin-header h2 i { color: var(--primary); }
    
    .admin-header .subtitle {
        color: rgba(255,255,255,0.55);
        font-size: 0.85rem;
        margin-top: 0.2rem;
    }

    .admin-form {
        background: #fff;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .form-section-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.1rem;
        color: var(--dark);
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--gray-200);
    }

    .upload-zone {
        border: 2px dashed var(--gray-300);
        border-radius: 16px;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: var(--gray-50);
        position: relative;
        min-height: 160px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .upload-zone:hover {
        border-color: var(--primary);
        background: rgba(201,169,89,0.04);
    }

    .upload-zone.has-image {
        border-style: solid;
        border-color: var(--primary);
        padding: 0.5rem;
    }

    .upload-zone i.upload-icon {
        font-size: 2.5rem;
        color: var(--gray-300);
        margin-bottom: 0.5rem;
    }

    .upload-zone p {
        color: var(--gray-500);
        font-size: 0.85rem;
        margin: 0;
    }

    .upload-zone input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }

    .upload-preview {
        max-width: 100%;
        max-height: 150px;
        border-radius: 10px;
        object-fit: cover;
    }

    .upload-label {
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--dark);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .upload-label .badge-detail {
        background: var(--primary);
        color: #fff;
        font-size: 0.7rem;
        padding: 0.15rem 0.5rem;
        border-radius: 999px;
    }

    .upload-label .optional {
        color: var(--gray-400);
        font-weight: 400;
        font-size: 0.8rem;
    }
</style>
@endsection

@section('content')
<div class="admin-page">
    <div class="container">
        <div class="admin-header">
            <div>
                <h2><i class="fas fa-plus-circle"></i> Ajouter un vêtement</h2>
                <div class="subtitle">Complétez les informations du nouveau modèle</div>
            </div>
            <a href="{{ route('admin.vetements.index') }}" class="btn btn-outline-custom" style="border-color: rgba(255,255,255,0.4); color: #fff;">
                <i class="fas fa-arrow-left me-2"></i> Retour
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="admin-form">
                    @if($errors->any())
                        <div class="alert alert-custom alert-error-custom mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.vetements.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <h5 class="form-section-title"><i class="fas fa-info-circle me-2" style="color:var(--primary);"></i>Informations générales</h5>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Nom du vêtement *</label>
                            <input type="text" name="nom" class="form-control form-control-custom" required placeholder="Ex: Costume mariage classique" value="{{ old('nom') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Description</label>
                            <textarea name="description" class="form-control form-control-custom" rows="4" placeholder="Décrivez les caractéristiques du vêtement...">{{ old('description') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Prix (CFA) *</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background:var(--gray-100);border:2px solid var(--gray-200);border-right:none;border-radius:6px 0 0 6px;">₣</span>
                                    <input type="number" name="prix" class="form-control form-control-custom" required min="0" placeholder="25000" value="{{ old('prix') }}" style="border-radius:0 6px 6px 0;">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Catégorie</label>
                                <select name="categorie_id" class="form-control form-control-custom">
                                    <option value="">Sélectionner une catégorie</option>
                                    @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                            {{ $categorie->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <h5 class="form-section-title mt-4"><i class="fas fa-image me-2" style="color:var(--primary);"></i>Photos du vêtement</h5>

                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <div class="upload-label">
                                    <i class="fas fa-camera" style="color:var(--primary);"></i>
                                    Photo principale *
                                </div>
                                <div class="upload-zone" id="zone-principale">
                                    <input type="file" name="image_principale" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" onchange="previewImage(this, 'preview-principale')">
                                    <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                    <p>Cliquez ou glissez-déposez la photo principale</p>
                                    <img id="preview-principale" class="upload-preview d-none">
                                </div>
                            </div>

                            @foreach(range(1, 3) as $i)
                            <div class="col-md-4">
                                <div class="upload-label">
                                    <i class="fas fa-image" style="color:var(--gray-400);"></i>
                                    Détail {{ $i }}
                                    <span class="optional">(optionnel)</span>
                                </div>
                                <div class="upload-zone" id="zone-detail-{{ $i }}">
                                    <input type="file" name="image_detail_{{ $i }}" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" onchange="previewImage(this, 'preview-detail-{{ $i }}')">
                                    <i class="fas fa-plus-circle upload-icon" style="font-size:1.8rem;"></i>
                                    <p style="font-size:0.8rem;">Photo détail {{ $i }}</p>
                                    <img id="preview-detail-{{ $i }}" class="upload-preview d-none">
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="disponible" id="disponible" {{ old('disponible', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="disponible">
                                    Disponible à la réservation
                                </label>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="fas fa-save me-2"></i> Enregistrer
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

@section('scripts')
<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const zone = input.closest('.upload-zone');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            zone.classList.add('has-image');
            const icon = zone.querySelector('.upload-icon');
            if (icon) icon.style.display = 'none';
            const p = zone.querySelector('p');
            if (p) p.style.display = 'none';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
