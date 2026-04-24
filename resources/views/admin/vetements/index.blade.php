@extends('layouts.master')

@section('title', 'Admin - Vêtements')

@section('content')
<div class="py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <h2 class="mb-0">Gestion des Vêtements</h2>
            <a href="{{ route('admin.vetements.create') }}" class="btn btn-primary-custom btn-sm">
                <i class="fas fa-plus me-2"></i> Ajouter
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
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th>Prix</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vetements as $vetement)
                        <tr id="row-{{ $vetement->id }}">
                            <td>
                                <img src="{{ $vetement->imageUrl }}" alt="{{ $vetement->nom }}" 
                                     class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                            </td>
                            <td><strong>{{ $vetement->nom }}</strong></td>
                            <td>{{ $vetement->categorie->nom ?? '-' }}</td>
                            <td>{{ number_format($vetement->prix, 0, ',', ' ') }} CFA</td>
                            <td>
                                @if($vetement->disponible)
                                    <span class="badge bg-success">Disponible</span>
                                @else
                                    <span class="badge bg-secondary">Indisponible</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.vetements.edit', $vetement->id) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="deleteVetement({{ $vetement->id }})" 
                                            class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Aucun vêtement pour le moment.
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