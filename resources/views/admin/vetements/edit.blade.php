@extends('layouts.master')

@section('title', 'Admin - Modifier le vêtement')

@section('styles')
<style>
    .rdv-page {
        padding: 1.5rem 0 4rem;
        min-height: 80vh;
        background: var(--gray-100);
    }

    .rdv-header {
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

    .rdv-header h2 {
        color: #fff;
        font-size: 1.7rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .rdv-header h2 i { color: var(--primary); }
    
    .rdv-header .subtitle {
        color: rgba(255,255,255,0.55);
        font-size: 0.85rem;
        margin-top: 0.2rem;
    }

    .form-custom {
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

    /* Badges taille */
    .taille-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.4rem;
    }
    .taille-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 36px;
        border: 2px solid var(--gray-300);
        border-radius: 8px;
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--gray-600);
        cursor: pointer;
        transition: all 0.2s ease;
        user-select: none;
        background: #fff;
    }
    .taille-badge.sur-mesure { width: auto; padding: 0 0.75rem; }
    .taille-badge:hover { border-color: var(--primary); color: var(--primary); background: rgba(201,169,89,0.06); }
    .taille-badge.active { border-color: var(--primary); background: var(--primary); color: #fff; box-shadow: 0 2px 8px rgba(201,169,89,0.3); }

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

    .current-image {
        width: 100%;
        max-height: 150px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid var(--gray-200);
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

    .current-img-label {
        font-size: 0.75rem;
        color: var(--gray-500);
        margin-bottom: 0.3rem;
    }
</style>
@endsection

@section('content')
<div class="rdv-page">
    <div class="container">
        <div class="rdv-header">
            <div>
                <h2><i class="fas fa-edit"></i> Modifier le vêtement</h2>
                <div class="subtitle">Mettez à jour les informations du modèle</div>
            </div>
            <a href="{{ route('admin.vetements.index') }}" class="btn btn-outline-custom" style="color:#fff;border-color:rgba(255,255,255,0.3);">
                <i class="fas fa-arrow-left me-2"></i> Retour
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

                    <form method="POST" action="{{ route('admin.vetements.update', $vetement->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <h5 class="form-section-title"><i class="fas fa-info-circle me-2" style="color:var(--primary);"></i>Informations générales</h5>

                        <div class="mb-3">
                            <label class="form-label-custom">Nom du vêtement *</label>
                            <input type="text" name="nom" class="form-control form-control-custom" 
                                   value="{{ $vetement->nom }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Description <span style="color:var(--gray-400);font-weight:400;font-size:0.82rem;">(optionnel)</span></label>
                            <textarea name="description" class="form-control form-control-custom" rows="4">{{ old('description', $vetement->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Taille disponible <span style="color:var(--gray-400);font-weight:400;font-size:0.82rem;">(optionnel)</span></label>
                            <input type="hidden" name="taille" id="taille_hidden" value="{{ old('taille', $vetement->taille) }}">
                            <div class="taille-badges">
                                @foreach(['XS','S','M','L','XL','XXL','Sur mesure'] as $t)
                                @php $currentTaille = old('taille', $vetement->taille); @endphp
                                <span class="taille-badge {{ $t === 'Sur mesure' ? 'sur-mesure' : '' }} {{ $currentTaille === $t ? 'active' : '' }}"
                                      onclick="selectTaille(this, '{{ $t }}')">
                                    {{ $t }}
                                </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Prix (CFA) *</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background:var(--gray-100);border:2px solid var(--gray-200);border-right:none;border-radius:6px 0 0 6px;">₣</span>
                                    <input type="number" name="prix" class="form-control form-control-custom" 
                                           value="{{ $vetement->prix }}" required min="0" style="border-radius:0 6px 6px 0;">
                                </div>
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

                        <h5 class="form-section-title mt-4"><i class="fas fa-image me-2" style="color:var(--primary);"></i>Photos du vêtement</h5>
                        <p class="text-muted" style="font-size:0.85rem;margin-bottom:1rem;">
                            <i class="fas fa-info-circle"></i> Laissez vide pour conserver la photo actuelle. Sélectionnez un fichier pour la remplacer.
                        </p>

                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <div class="upload-label">
                                    <i class="fas fa-camera" style="color:var(--primary);"></i>
                                    Photo principale
                                </div>
                                @php $mainImage = $vetement->images->where('ordre', 0)->first(); @endphp
                                @if($mainImage)
                                    <div class="current-img-label">Actuelle :</div>
                                    <img src="{{ str_starts_with($mainImage->image_url, 'http') ? $mainImage->image_url : \Illuminate\Support\Facades\Storage::url($mainImage->image_url) }}" class="current-image mb-2"
                                         onerror="this.style.display='none'">
                                @endif
                                <div class="upload-zone" id="zone-principale">
                                    <input type="file" name="image_principale" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" onchange="previewImage(this, 'preview-principale')">
                                    <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                    <p>Cliquez pour changer la photo principale</p>
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
                                @php $detailImage = $vetement->images->where('ordre', $i)->first(); @endphp
                                @if($detailImage)
                                    <div class="current-img-label">Actuelle :</div>
                                    <img src="{{ str_starts_with($detailImage->image_url, 'http') ? $detailImage->image_url : \Illuminate\Support\Facades\Storage::url($detailImage->image_url) }}" class="current-image mb-2"
                                         onerror="this.style.display='none'">
                                @endif
                                <div class="upload-zone" id="zone-detail-{{ $i }}">
                                    <input type="file" name="image_detail_{{ $i }}" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" onchange="previewImage(this, 'preview-detail-{{ $i }}')">
                                    <i class="fas fa-plus-circle upload-icon" style="font-size:1.8rem;"></i>
                                    <p style="font-size:0.8rem;">{{ $detailImage ? 'Changer' : 'Ajouter' }} la photo détail {{ $i }}</p>
                                    <img id="preview-detail-{{ $i }}" class="upload-preview d-none">
                                </div>
                            </div>
                            @endforeach
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

function selectTaille(el, val) {
    document.querySelectorAll('.taille-badge').forEach(b => b.classList.remove('active'));
    const hidden = document.getElementById('taille_hidden');
    if (hidden.value === val) {
        hidden.value = '';
    } else {
        el.classList.add('active');
        hidden.value = val;
    }
}
</script>
@endsection
