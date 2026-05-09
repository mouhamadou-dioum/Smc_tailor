@extends('layouts.master')

@section('title', 'Admin - Catégories')

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
        margin-bottom: 1rem;
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

    .admin-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        border: 1.5px solid var(--gray-200);
        padding: 1.25rem;
        transition: all 0.3s ease;
    }

    .admin-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        border-color: var(--primary);
    }

    .admin-form {
        background: #fff;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .form-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .action-btn.edit {
        background: rgba(201,169,89,0.15);
        color: var(--primary);
    }

    .action-btn.edit:hover {
        background: var(--primary);
        color: white;
        transform: scale(1.1);
    }

    .action-btn.delete {
        background: rgba(239,68,68,0.15);
        color: #ef4444;
    }

    .action-btn.delete:hover {
        background: #ef4444;
        color: white;
        transform: scale(1.1);
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        background: var(--gray-100);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 2rem;
        color: var(--gray-400);
    }

    .category-count {
        background: var(--gray-100);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        color: var(--gray-600);
    }
</style>
@endsection

@section('content')
<div class="admin-page">
    <div class="container">
        {{-- Header --}}
        <div class="admin-header">
            <div>
                <h2><i class="fas fa-tags"></i> Gestion des Catégories</h2>
                <div class="subtitle">Organisez vos vêtements par catégorie</div>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-custom" style="border-color: rgba(255,255,255,0.4); color: #fff;">
                <i class="fas fa-arrow-left me-2"></i> Tableau de bord
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-custom alert-success-custom mb-4">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        <div class="row g-4">
            {{-- Formulaire d'ajout --}}
            <div class="col-lg-4">
                <div class="admin-form">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="form-icon">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div>
                            <h4 class="mb-0" style="font-family:'Playfair Display',serif;">Nouvelle catégorie</h4>
                            <small class="text-muted">Ajoutez une catégorie</small>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label-custom">Nom *</label>
                            <input type="text" name="nom" class="form-control form-control-custom" placeholder="Ex: Costume, Boubou, Robe..." required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label-custom">Description</label>
                            <textarea name="description" class="form-control form-control-custom" rows="3" placeholder="Description optionnelle..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100">
                            <i class="fas fa-plus me-2"></i> Ajouter la catégorie
                        </button>
                    </form>
                </div>
            </div>

            {{-- Liste des catégories --}}
            <div class="col-lg-8">
                <div class="row g-3">
                    @forelse($categories as $categorie)
                    <div class="col-md-6">
                        <div class="admin-card">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex gap-3">
                                    <div class="form-icon" style="width:45px;height:45px;font-size:1rem;flex-shrink:0;">
                                        <i class="fas fa-tag"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1" style="font-family:'Playfair Display',serif;">{{ $categorie->nom }}</h5>
                                        <p class="text-muted mb-2" style="font-size:0.875rem;">{{ $categorie->description ?? 'Aucune description' }}</p>
                                        <span class="category-count">
                                            <i class="fas fa-tshirt fa-xs me-1"></i>{{ $categorie->vetements->count() }} vêtement(s)
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <button onclick="editCategorie({{ $categorie->id }}, '{{ $categorie->nom }}', '{{ $categorie->description }}')" 
                                            class="action-btn edit" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteCategorie({{ $categorie->id }})" 
                                            class="action-btn delete" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <div class="empty-icon">
                                <i class="fas fa-tags"></i>
                            </div>
                            <h4 style="font-family:'Playfair Display',serif; color:var(--dark);">Aucune catégorie</h4>
                            <p class="text-muted">Commencez par ajouter une catégorie pour organizer vos vêtements.</p>
                            <a href="#" onclick="document.querySelector('.admin-form form').scrollIntoView({behavior:'smooth'})" class="btn btn-primary-custom mt-2">
                                <i class="fas fa-plus me-2"></i> Ajouter une catégorie
                            </a>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius:16px;">
            <form method="POST" id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-header" style="border-bottom:1px solid var(--gray-200);">
                    <h5 class="modal-title" style="font-family:'Playfair Display',serif;">Modifier la catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label-custom">Nom *</label>
                        <input type="text" name="nom" id="editNom" class="form-control form-control-custom" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Description</label>
                        <textarea name="description" id="editDescription" class="form-control form-control-custom" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="border-top:1px solid var(--gray-200);">
                    <button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary-custom">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function editCategorie(id, nom, description) {
    document.getElementById('editNom').value = nom;
    document.getElementById('editDescription').value = description || '';
    document.getElementById('editForm').action = '/admin/categories/' + id;
    new bootstrap.Modal(document.getElementById('editModal')).show();
}

function deleteCategorie(id) {
    if (confirm('Voulez-vous vraiment supprimer cette catégorie?')) {
        fetch(`/admin/categories/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(() => location.reload());
    }
}
</script>
@endsection