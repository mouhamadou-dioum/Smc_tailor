@extends('layouts.master')

@section('title', 'Nos Vêtements - Couture App')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Nos Créations</h2>
            <p class="section-subtitle">Découvrez notre collection exclusive</p>
        </div>

        @if($categories->count() > 0)
        <div class="mb-5">
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <a href="{{ route('vetements.index') }}" 
                   class="btn {{ !$categorieId ? 'btn-primary-custom' : 'btn-outline-custom' }}">
                    Tous
                </a>
                @foreach($categories as $categorie)
                    <a href="{{ route('vetements.index', ['categorie' => $categorie->id]) }}" 
                       class="btn {{ $categorieId == $categorie->id ? 'btn-primary-custom' : 'btn-outline-custom' }}">
                        {{ $categorie->nom }}
                    </a>
                @endforeach
            </div>
        </div>
        @endif

        <div class="row g-4">
            @forelse($vetements as $vetement)
                <div class="col-md-6 col-lg-4">
                    <div class="card-custom h-100">
                        <div class="featured-card">
                            <img
                                src="{{ $vetement->imageUrl ?: 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=1200' }}"
                                alt="{{ $vetement->nom }}"
                                class="img-fluid"
                                onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1445205170230-053b83016050?w=1200';"
                            >
                            @if(!$vetement->disponible)
                                <span class="badge bg-secondary position-absolute top-0 end-0 m-2">Indisponible</span>
                            @endif
                            <div class="featured-overlay">
                                <span class="price-tag">{{ number_format($vetement->prix, 0, ',', ' ') }} CFA</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h5 class="mb-2">{{ $vetement->nom }}</h5>
                            <p class="text-muted small mb-3">{{ \Illuminate\Support\Str::limit($vetement->description ?? '', 80) }}</p>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-custom flex-grow-1" data-bs-toggle="modal" data-bs-target="#vetementModal{{ $vetement->id }}">
                                    <i class="fas fa-eye me-1"></i> Détails
                                </button>
                                @if($vetement->disponible)
                                    <a href="{{ route('rendezvous.create') }}?vetement={{ $vetement->id }}" class="btn btn-primary-custom flex-grow-1">
                                        <i class="fas fa-calendar-plus me-1"></i> Réserver
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="vetementModal{{ $vetement->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img
                                            src="{{ $vetement->imageUrl ?: 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=1200' }}"
                                            alt="{{ $vetement->nom }}"
                                            class="img-fluid rounded"
                                            onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1445205170230-053b83016050?w=1200';"
                                        >
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="mb-3">{{ $vetement->nom }}</h3>
                                        @if($vetement->categorie)
                                            <span class="badge badge-admin mb-2">{{ $vetement->categorie->nom }}</span>
                                        @endif
                                        <span class="price-tag mb-3 d-inline-block">{{ number_format($vetement->prix, 0, ',', ' ') }} CFA</span>
                                        <p class="mt-3">{{ $vetement->description }}</p>
                                        <div class="mt-4">
                                            @if($vetement->disponible)
                                                <a href="{{ route('rendezvous.create') }}?vetement={{ $vetement->id }}" class="btn btn-primary-custom">
                                                    <i class="fas fa-calendar-plus me-1"></i> Réserver ce vêtement
                                                </a>
                                            @else
                                                <button class="btn btn-secondary" disabled>Indisponible</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-box-open" style="font-size: 4rem; color: var(--gray-400);"></i>
                    <p class="mt-3 text-muted">Aucun vêtement disponible pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection