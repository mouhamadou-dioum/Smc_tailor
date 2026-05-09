@extends('layouts.master')

@section('title', 'Admin - Vêtements')

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

    .vetement-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        border: 1.5px solid var(--gray-200);
        padding: 1.25rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .vetement-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        border-color: var(--primary);
    }

    .vetement-image {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        object-fit: cover;
        background: var(--gray-100);
        flex-shrink: 0;
    }

    .vetement-info {
        flex: 1;
    }

    .vetement-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.1rem;
        color: var(--dark);
        margin-bottom: 0.25rem;
    }

    .vetement-meta {
        font-size: 0.85rem;
        color: var(--gray-600);
    }

    .vetement-price {
        font-weight: 600;
        color: var(--primary);
        font-size: 1rem;
    }

    .status-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .status-badge.disponible {
        background: rgba(40,167,69,0.15);
        color: #28a745;
    }

    .status-badge.indisponible {
        background: rgba(239,68,68,0.15);
        color: #ef4444;
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
</style>
@endsection

@section('content')
<div class="admin-page">
    <div class="container">
        {{-- Header --}}
        <div class="admin-header">
            <div>
                <h2><i class="fas fa-tshirt"></i> Gestion des Vêtements</h2>
                <div class="subtitle">Gérez votre collection et les disponibilités</div>
            </div>
            <a href="{{ route('admin.vetements.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus me-2"></i> Ajouter un vêtement
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-custom alert-success-custom mb-4">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        {{-- Cards Grid --}}
        <div class="row g-3">
            @forelse($vetements as $vetement)
            <div class="col-md-6 col-lg-4" id="row-{{ $vetement->id }}">
                <div class="vetement-card" style="flex-direction:column;align-items:stretch;">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ $vetement->imageUrl }}" alt="{{ $vetement->nom }}" 
                             class="vetement-image" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect fill=%22%23f5f5f5%22 width=%22100%22 height=%22100%22/><text x=%2250%22 y=%2255%22 font-size=%2240%22 text-anchor=%22middle%22 fill=%22%23ccc%22>👔</text></svg>'">
                        <div class="vetement-info">
                            <div class="vetement-title">{{ $vetement->nom }}</div>
                            <div class="vetement-meta">
                                <i class="fas fa-tag fa-xs me-1"></i>{{ $vetement->categorie->nom ?? 'Non classé' }}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3" style="border-top:1px solid var(--gray-200);">
                        <div class="d-flex align-items-center gap-3">
                            <span class="vetement-price">{{ number_format($vetement->prix, 0, ',', ' ') }} CFA</span>
                            <span class="status-badge {{ $vetement->disponible ? 'disponible' : 'indisponible' }}">
                                {{ $vetement->disponible ? 'Disponible' : 'Indisponible' }}
                            </span>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.vetements.edit', $vetement->id) }}" class="action-btn edit" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button onclick="deleteVetement({{ $vetement->id }})" class="action-btn delete" title="Supprimer">
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
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <h4 style="font-family:'Playfair Display',serif; color:var(--dark);">Aucun vêtement</h4>
                    <p class="text-muted">Commencez par ajouter votre premier vêtement.</p>
                    <a href="{{ route('admin.vetements.create') }}" class="btn btn-primary-custom mt-2">
                        <i class="fas fa-plus me-2"></i> Ajouter un vêtement
                    </a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function deleteVetement(id) {
    if (confirm('Voulez-vous vraiment supprimer ce vêtement?')) {
        fetch(`/admin/vetements/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById(`row-${id}`).remove();
            alert('Vêtement supprimé!');
        });
    }
}
</script>
@endsection