@extends('layouts.master')

@section('title', 'Nos Vêtements - Couture App')

@section('styles')
<style>
    /* ── Hero Banner ── */
    .vetements-hero {
        background: linear-gradient(135deg, var(--dark) 0%, #252545 60%, #1f3a52 100%);
        padding: 4rem 0 3rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .vetements-hero::before {
        content: '';
        position: absolute;
        top: -30%;
        left: 50%;
        transform: translateX(-50%);
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(201,169,89,0.15) 0%, transparent 70%);
        pointer-events: none;
    }

    /* ── Category Filter & Search Bar ── */
    .filter-box {
        background: #fff;
        padding: 1.25rem 1.5rem;
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(0,0,0,0.03);
        margin-bottom: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1.25rem;
        border: 1px solid var(--gray-200);
    }

    .filter-groups {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .search-input-group {
        position: relative;
        min-width: 250px;
        flex-grow: 1;
    }

    @media (min-width: 992px) {
        .search-input-group {
            flex-grow: 0;
            width: 300px;
        }
    }

    .search-input-group i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-500);
    }

    .search-control {
        width: 100%;
        padding: 0.55rem 1rem 0.55rem 2.5rem;
        border-radius: 50px;
        border: 1.5px solid var(--gray-300);
        background: var(--gray-100);
        font-size: 0.85rem;
        transition: all 0.25s;
    }

    .search-control:focus {
        background: #fff;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(201,169,89,0.15);
        outline: none;
    }

    .filter-btn {
        padding: 0.45rem 1.1rem;
        border-radius: 999px;
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.25s;
        border: 1.5px solid var(--gray-300);
        color: var(--gray-700);
        background: #fff;
        white-space: nowrap;
    }

    .filter-btn:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: rgba(201,169,89,0.06);
    }

    .filter-btn.active {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
        box-shadow: 0 4px 12px rgba(201,169,89,0.35);
    }

    /* ── Card ── */
    .vet-card {
        background: #fff;
        border-radius: 20px;
        border: 1.5px solid var(--gray-200);
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        overflow: hidden;
        transition: all 0.35s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .vet-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(0,0,0,0.13);
        border-color: var(--primary);
    }

    /* ── Image Wrapper ── */
    .vet-img-wrap {
        position: relative;
        overflow: hidden;
        aspect-ratio: 3/4;
        flex-shrink: 0;
    }

    .vet-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
        transition: transform 0.45s ease;
    }

    .vet-card:hover .vet-img-wrap img {
        transform: scale(1.05);
    }

    /* ── Price Badge ── */
    .price-badge {
        position: absolute;
        bottom: 12px;
        left: 12px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: #fff;
        font-family: 'Playfair Display', serif;
        font-size: 0.95rem;
        font-weight: 700;
        padding: 0.4rem 0.9rem;
        border-radius: 999px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.25);
        letter-spacing: 0.3px;
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    .price-badge .cfa {
        font-family: 'Lato', sans-serif;
        font-size: 0.7rem;
        font-weight: 600;
        opacity: 0.85;
        letter-spacing: 0.5px;
    }

    /* ── Indispo Badge ── */
    .indispo-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(30,30,30,0.75);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 0.3rem 0.75rem;
        border-radius: 999px;
        backdrop-filter: blur(4px);
    }

    /* ── Categorie Badge (sur image) ── */
    .cat-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(255,255,255,0.9);
        color: var(--dark);
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        padding: 0.28rem 0.7rem;
        border-radius: 999px;
        backdrop-filter: blur(4px);
        border: 1px solid rgba(255,255,255,0.5);
    }

    /* ── Card Body ── */
    .vet-card-body {
        padding: 1.1rem 1.25rem 1.25rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .vet-card-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0 0 0.4rem;
    }

    .vet-card-desc {
        font-size: 0.82rem;
        color: var(--gray-600);
        margin: 0 0 1rem;
        line-height: 1.5;
        flex: 1;
    }

    /* ── Card Buttons ── */
    .vet-card-actions {
        display: flex;
        gap: 0.6rem;
    }

    .btn-detail {
        flex: 1;
        border: 1.5px solid var(--gray-300);
        color: var(--gray-700);
        background: transparent;
        border-radius: 10px;
        padding: 0.5rem 0.75rem;
        font-size: 0.82rem;
        font-weight: 600;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
    }

    .btn-detail:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: rgba(201,169,89,0.05);
    }

    .btn-reserver {
        flex: 1;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 0.5rem 0.75rem;
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        transition: all 0.25s;
        box-shadow: 0 4px 10px rgba(201,169,89,0.3);
    }

    .btn-reserver:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(201,169,89,0.4);
    }

    /* ── Empty State ── */
    .empty-vetements {
        background: #fff;
        border-radius: 20px;
        border: 1.5px dashed var(--gray-300);
        padding: 5rem 2rem;
        text-align: center;
        color: var(--gray-500);
    }

    .empty-vetements i {
        font-size: 3.5rem;
        opacity: 0.2;
        display: block;
        margin-bottom: 1rem;
        color: var(--dark);
    }

    /* ── Modal ── */
    .modal-content {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 24px 60px rgba(0,0,0,0.18);
    }

    .modal-body { padding: 0; }

    .modal-img {
        width: 100%;
        height: 100%;
        min-height: 280px;
        object-fit: cover;
        object-position: top center;
    }

    /* ── Modal Carousel ── */
    .modal-carousel {
        height: 100%;
        min-height: 420px;
    }
    .modal-carousel .carousel-inner {
        height: 100%;
    }
    .modal-carousel .carousel-item {
        height: 100%;
    }
    .modal-carousel .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
    }
    .modal-carousel .carousel-control-prev,
    .modal-carousel .carousel-control-next {
        width: 15%;
        opacity: 0;
        transition: opacity 0.3s;
    }
    .modal-carousel:hover .carousel-control-prev,
    .modal-carousel:hover .carousel-control-next {
        opacity: 0.7;
    }
    .modal-carousel .carousel-control-prev-icon,
    .modal-carousel .carousel-control-next-icon {
        background-color: rgba(0,0,0,0.3);
        border-radius: 50%;
        padding: 1.2rem;
        background-size: 50%;
    }
    .modal-carousel .carousel-indicators {
        margin-bottom: 0.5rem;
        gap: 0.35rem;
    }
    .modal-carousel .carousel-indicators button {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        border: 2px solid rgba(255,255,255,0.6);
        background: transparent;
        opacity: 1;
    }
    .modal-carousel .carousel-indicators button.active {
        background: #fff;
        border-color: #fff;
    }
    .carousel-img-wrap {
        height: 100%;
        min-height: 420px;
        position: relative;
        background: var(--gray-200);
    }
    .carousel-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
    }

    .modal-info {
        padding: 2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .modal-vet-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        margin: 0 0 0.75rem;
    }

    /* ── Modal Price Badge ── */
    .modal-price-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: #fff;
        font-family: 'Playfair Display', serif;
        font-size: 1.15rem;
        font-weight: 700;
        padding: 0.45rem 1.1rem;
        border-radius: 999px;
        box-shadow: 0 4px 14px rgba(201,169,89,0.35);
        margin-bottom: 1rem;
        width: fit-content;
    }

    .modal-price-badge .cfa {
        font-family: 'Lato', sans-serif;
        font-size: 0.75rem;
        opacity: 0.85;
        font-weight: 600;
    }

    .modal-cat-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: var(--gray-100);
        border: 1px solid var(--gray-200);
        color: var(--gray-700);
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        padding: 0.28rem 0.75rem;
        border-radius: 999px;
        margin-bottom: 0.5rem;
        width: fit-content;
    }

    .modal-desc {
        font-size: 0.88rem;
        color: var(--gray-600);
        line-height: 1.65;
        margin: 0.75rem 0 1.5rem;
    }

    .btn-modal-reserver {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 0.7rem 1.5rem;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.25s;
        box-shadow: 0 4px 14px rgba(201,169,89,0.35);
        width: fit-content;
    }

    .btn-modal-reserver:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(201,169,89,0.45);
    }

    .modal-close-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(255,255,255,0.9);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: background 0.2s;
        font-size: 0.8rem;
        color: var(--dark);
    }

    .modal-close-btn:hover { background: #fff; }

    @media (max-width: 576px) {
        .vet-img-wrap { aspect-ratio: 2/3; }
        .vetements-hero { padding: 2.5rem 0 2rem; }
    }
</style>
@endsection

@section('content')

{{-- Hero Banner --}}
<section class="vetements-hero">
    <div class="container">
        <h1 class="hero-title">Nos Créations</h1>
        <p class="hero-subtitle">Découvrez notre collection exclusive</p>
    </div>
</section>

<section class="py-5" style="background: var(--gray-100);">
    <div class="container">

        {{-- Category Filter & Search Bar --}}
        <div class="filter-box">
            <div class="filter-groups">
                <a href="{{ route('vetements.index') }}"
                   class="filter-btn {{ !$categorieId ? 'active' : '' }}">
                    <i class="fas fa-th-large me-1"></i> Tous
                </a>
                @if($categories->count() > 0)
                    @foreach($categories as $categorie)
                        <a href="{{ route('vetements.index', ['categorie' => $categorie->id]) }}"
                           class="filter-btn {{ $categorieId == $categorie->id ? 'active' : '' }}">
                            {{ $categorie->nom }}
                        </a>
                    @endforeach
                @endif
            </div>

            <div class="search-input-group">
                <i class="fas fa-search"></i>
                <input type="text" id="vetementSearch" class="search-control" placeholder="Rechercher un modèle...">
            </div>
        </div>

        {{-- Grid --}}
        <div class="row g-4" id="vetementsGrid">
            @forelse($vetements as $vetement)
            @php
                $allImages = $vetement->images->sortBy('ordre');
                $mainImg = $allImages->first()?->image_url;
                $cardImgSrc = $mainImg
                    ? (str_starts_with($mainImg, 'http') ? $mainImg : \Illuminate\Support\Facades\Storage::url($mainImg))
                    : 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=800';
                $fallbackUrl = 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=800';
            @endphp
            <div class="col-md-6 col-lg-4 vetement-item" data-nom="{{ strtolower($vetement->nom) }}" data-desc="{{ strtolower($vetement->description ?? '') }}">
                <div class="vet-card">

                    {{-- Image --}}
                    <div class="vet-img-wrap">
                        <img
                            src="{{ $cardImgSrc }}"
                            alt="{{ $vetement->nom }}"
                            onerror="this.onerror=null;this.src='{{ $fallbackUrl }}';"
                        >

                        {{-- Catégorie --}}
                        @if($vetement->categorie)
                            <span class="cat-badge">
                                <i class="fas fa-tag fa-xs"></i> {{ $vetement->categorie->nom }}
                            </span>
                        @endif

                        {{-- Indisponible --}}
                        @if(!$vetement->disponible)
                            <span class="indispo-badge">Indisponible</span>
                        @endif

                        {{-- Prix Badge --}}
                        <span class="price-badge">
                            {{ number_format($vetement->prix, 0, ',', ' ') }}
                            <span class="cfa">CFA</span>
                        </span>
                    </div>

                    {{-- Body --}}
                    <div class="vet-card-body">
                        <h5 class="vet-card-name">{{ $vetement->nom }}</h5>
                        <p class="vet-card-desc">{{ \Illuminate\Support\Str::limit($vetement->description ?? '', 85) }}</p>

                        <div class="vet-card-actions">
                            <button class="btn-detail"
                                    data-bs-toggle="modal"
                                    data-bs-target="#vetementModal{{ $vetement->id }}">
                                <i class="fas fa-eye"></i> Détails
                            </button>
                            @if($vetement->disponible)
                                @auth('client')
                                <a href="{{ route('rendezvous.create') }}?vetement={{ $vetement->id }}"
                                   class="btn-reserver">
                                    <i class="fas fa-calendar-plus"></i> Réserver
                                </a>
                                @else
                                <a href="{{ route('register') }}"
                                   class="btn-reserver">
                                    <i class="fas fa-user-plus"></i> S'inscrire
                                </a>
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal --}}
            <div class="modal fade" id="vetementModal{{ $vetement->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="row g-0" style="min-height: 420px;">
                            {{-- Image Carousel --}}
                            <div class="col-md-5 p-0 modal-carousel">
                                <div id="carousel-{{ $vetement->id }}" class="carousel slide h-100" data-bs-ride="false">
                                    <div class="carousel-inner h-100">
                                        @php
                                            $allModalImages = $allImages->count() > 0 ? $allImages : collect([
                                                (object)['image_url' => 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=1200']
                                            ]);
                                        @endphp
                                        @foreach($allModalImages as $index => $img)
                                        @php
                                            $imgSrc = str_starts_with($img->image_url, 'http') ? $img->image_url : \Illuminate\Support\Facades\Storage::url($img->image_url);
                                        @endphp
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <div class="carousel-img-wrap">
                                                <img src="{{ $imgSrc }}"
                                                     alt="{{ $vetement->nom }} - Image {{ $index + 1 }}"
                                                     onerror="this.onerror=null;this.src='{{ $fallbackUrl }}';">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    @if($allModalImages->count() > 1)
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $vetement->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Précédent</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $vetement->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Suivant</span>
                                    </button>

                                    <div class="carousel-indicators">
                                        @foreach($allModalImages as $index => $img)
                                        <button type="button"
                                                data-bs-target="#carousel-{{ $vetement->id }}"
                                                data-bs-slide-to="{{ $index }}"
                                                class="{{ $index === 0 ? 'active' : '' }}"
                                                aria-label="Image {{ $index + 1 }}"></button>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Info --}}
                            <div class="col-md-7 modal-info position-relative">
                                <button type="button" class="modal-close-btn d-none d-md-flex" data-bs-dismiss="modal">
                                    <i class="fas fa-times"></i>
                                </button>

                                @if($vetement->categorie)
                                    <span class="modal-cat-badge">
                                        <i class="fas fa-tag fa-xs"></i> {{ $vetement->categorie->nom }}
                                    </span>
                                @endif

                                <h3 class="modal-vet-name">{{ $vetement->nom }}</h3>

                                {{-- Prix Badge Modal --}}
                                <span class="modal-price-badge">
                                    {{ number_format($vetement->prix, 0, ',', ' ') }}
                                    <span class="cfa">CFA</span>
                                </span>

                                <p class="modal-desc">{{ $vetement->description }}</p>

                                @if($vetement->disponible)
                                    @auth('client')
                                    <a href="{{ route('rendezvous.create') }}?vetement={{ $vetement->id }}"
                                       class="btn-modal-reserver">
                                        <i class="fas fa-calendar-plus"></i> Réserver ce vêtement
                                    </a>
                                    @else
                                    <a href="{{ route('register') }}" class="btn-modal-reserver">
                                        <i class="fas fa-user-plus"></i> Créer un compte pour réserver
                                    </a>
                                    @endauth
                                @else
                                    <span style="background:#f8d7da;color:#721c24;padding:0.5rem 1rem;border-radius:10px;font-size:0.85rem;font-weight:600;display:inline-flex;align-items:center;gap:0.4rem;">
                                        <i class="fas fa-times-circle"></i> Indisponible actuellement
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @empty
            <div class="col-12">
                <div class="empty-vetements">
                    <i class="fas fa-box-open"></i>
                    <h5 style="font-family:'Playfair Display',serif;color:var(--dark);margin-bottom:0.4rem;">
                        Aucun vêtement disponible
                    </h5>
                    <p class="mb-0">Revenez bientôt pour découvrir nos nouvelles créations.</p>
                </div>
            </div>
            @endforelse
        </div>

    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.getElementById('vetementSearch');
    var items       = document.querySelectorAll('.vetement-item');

    if (searchInput) {
        searchInput.addEventListener('input', function (e) {
            var val = e.target.value.toLowerCase().trim();

            items.forEach(function (item) {
                var nom  = item.getAttribute('data-nom') || '';
                var desc = item.getAttribute('data-desc') || '';
                if (nom.includes(val) || desc.includes(val)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
});
</script>
@endsection