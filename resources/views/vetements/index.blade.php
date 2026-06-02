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

    .btn-commander-wa {
        flex: 1;
        background: #25d366;
        color: #fff !important;
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
        box-shadow: 0 4px 10px rgba(37, 211, 102, 0.25);
    }

    .btn-commander-wa:hover {
        background: #20ba5a;
        color: #fff !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(37, 211, 102, 0.4);
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

    /* ── Modal Premium Couture ── */
    .modal-content {
        border: 1px solid rgba(201,169,89,0.2);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 24px 60px rgba(0,0,0,0.25);
        background: #fdfcf9; /* Teinte ivoire douce */
    }

    .modal-body {
        padding: 0;
    }

    /* ── Image & Carousel section ── */
    .modal-carousel-panel {
        background: #f4f0e6;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 1.5rem;
        border-right: 1px solid rgba(201,169,89,0.15);
    }

    .modal-carousel {
        width: 100%;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        border: 1px solid rgba(201,169,89,0.15);
    }

    .carousel-img-wrap {
        aspect-ratio: 3/4;
        position: relative;
        background: #fdfcf9;
    }

    .carousel-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
        transition: transform 0.6s ease;
    }

    .modal-carousel .carousel-control-prev,
    .modal-carousel .carousel-control-next {
        width: 12%;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .modal-carousel:hover .carousel-control-prev,
    .modal-carousel:hover .carousel-control-next {
        opacity: 1;
    }

    .modal-carousel .carousel-control-prev-icon,
    .modal-carousel .carousel-control-next-icon {
        background-color: rgba(26, 26, 26, 0.7);
        border-radius: 50%;
        padding: 1rem;
        background-size: 40%;
        border: 1px solid rgba(201,169,89,0.3);
    }

    /* Vignettes Interactives (Thumbnails) */
    .thumbnail-btn {
        width: 60px;
        height: 80px;
        padding: 0;
        border: 1.5px solid var(--gray-300);
        border-radius: 8px;
        overflow: hidden;
        background: transparent;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        cursor: pointer;
    }

    .thumbnail-btn img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
    }

    .thumbnail-btn:hover {
        border-color: var(--primary);
        transform: translateY(-2px);
    }

    .thumbnail-btn.active {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(201,169,89,0.35);
        transform: translateY(-2px);
    }

    /* ── Info Panel ── */
    .modal-info {
        padding: 3rem 2.5rem;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        max-height: 85vh;
        overflow-y: auto;
    }

    .modal-meta-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
    }

    .modal-cat-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: rgba(201,169,89,0.1);
        border: 1px solid rgba(201,169,89,0.25);
        color: var(--gold-dark);
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 0.35rem 0.85rem;
        border-radius: 999px;
    }

    .modal-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.2);
        color: #065f46;
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.3rem 0.75rem;
        border-radius: 999px;
    }

    .modal-status-badge.indispo {
        background: rgba(239, 68, 68, 0.1);
        border-color: rgba(239, 68, 68, 0.2);
        color: #991b1b;
    }

    .modal-vet-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.2rem;
        font-weight: 400;
        color: var(--charcoal);
        margin: 0 0 1rem;
        line-height: 1.15;
    }

    /* ── Price Block Couture ── */
    .modal-price-box {
        background: rgba(201,169,89,0.05);
        border: 1.5px solid rgba(201,169,89,0.25);
        border-radius: 12px;
        padding: 0.8rem 1.2rem;
        width: fit-content;
        margin-bottom: 1.5rem;
    }

    .modal-price-box-label {
        font-size: 0.6rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--gold-dark);
        font-weight: 600;
        margin-bottom: 0.25rem;
        display: block;
    }

    .modal-price-box-val {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--gold-dark);
        line-height: 1;
        display: flex;
        align-items: baseline;
        gap: 0.35rem;
    }

    .modal-price-box-val .cfa {
        font-family: 'Lato', sans-serif;
        font-size: 0.95rem;
        font-weight: 700;
    }

    .modal-divider {
        height: 1px;
        background: linear-gradient(to right, rgba(201,169,89,0.25), rgba(201,169,89,0.05));
        margin: 1.5rem 0;
        width: 100%;
    }

    .modal-desc-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.15rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--charcoal-mid);
        margin-bottom: 0.5rem;
    }

    .modal-desc {
        font-size: 0.88rem;
        color: var(--warm-gray);
        line-height: 1.75;
        margin-bottom: 1.5rem;
    }

    /* ── Fiche Technique Grid ── */
    .specs-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
        margin-bottom: 1.75rem;
    }

    .spec-item {
        display: flex;
        gap: 0.75rem;
        align-items: flex-start;
        padding: 0.8rem;
        background: #fcfbfa;
        border-radius: 12px;
        border: 1px solid rgba(201,169,89,0.15);
        transition: transform 0.3s ease;
    }

    .spec-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    }

    .spec-item i {
        font-size: 1.1rem;
        color: var(--primary);
        margin-top: 0.1rem;
    }

    .spec-item-label {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--gray-500);
        font-weight: 600;
        margin-bottom: 0.15rem;
        line-height: 1;
    }

    .spec-item-value {
        font-size: 0.82rem;
        font-weight: 500;
        color: var(--charcoal-mid);
        line-height: 1.3;
    }

    /* ── Timeline ── */
    .process-timeline {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin: 2rem 0;
        padding: 0.5rem 0 1rem;
    }

    .process-timeline::before {
        content: '';
        position: absolute;
        top: 21px;
        left: 10%;
        right: 10%;
        height: 1px;
        background: linear-gradient(to right, transparent, rgba(201,169,89,0.35) 20%, rgba(201,169,89,0.35) 80%, transparent);
        z-index: 1;
    }

    .timeline-step {
        position: relative;
        z-index: 2;
        text-align: center;
        width: 22%;
    }

    .timeline-dot {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 1px solid var(--primary);
        background: #fdfcf9;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Cormorant Garamond', serif;
        font-size: 0.9rem;
        color: var(--primary);
        margin: 0 auto 0.5rem;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .timeline-step:hover .timeline-dot {
        background: var(--primary);
        color: #fff;
        transform: scale(1.1);
        box-shadow: 0 0 8px rgba(201,169,89,0.4);
    }

    .timeline-lbl {
        font-size: 0.65rem;
        color: var(--gray-600);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        line-height: 1.2;
    }

    /* ── Boutons d'Action Premium ── */
    .modal-actions-container {
        display: flex;
        gap: 0.75rem;
        align-items: center;
        flex-wrap: wrap;
        margin-top: 1.5rem;
    }

    .btn-modal-reserve-premium {
        flex-grow: 1;
        background: linear-gradient(135deg, var(--charcoal), var(--charcoal-mid));
        color: var(--gold-light) !important;
        border: 1.5px solid var(--gold);
        border-radius: 8px;
        padding: 0.85rem 1.75rem;
        font-family: 'Jost', sans-serif;
        font-size: 0.75rem;
        font-weight: 500;
        letter-spacing: 2px;
        text-transform: uppercase;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        text-decoration: none;
        box-shadow: 0 4px 14px rgba(0,0,0,0.15);
    }

    .btn-modal-reserve-premium:hover {
        background: var(--gold);
        color: var(--charcoal) !important;
        border-color: var(--gold);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(201,169,89,0.35);
    }

    .btn-modal-whatsapp {
        background: transparent;
        color: #25d366 !important;
        border: 1.5px solid #25d366;
        border-radius: 8px;
        padding: 0.85rem 1.5rem;
        font-family: 'Jost', sans-serif;
        font-size: 0.75rem;
        font-weight: 500;
        letter-spacing: 2px;
        text-transform: uppercase;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-modal-whatsapp:hover {
        background: #25d366;
        color: #fff !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 211, 102, 0.25);
    }

    .modal-disclaimer {
        font-size: 0.72rem;
        color: var(--gray-500);
        margin-top: 1rem;
        display: block;
        line-height: 1.4;
    }

    .modal-close-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #fdfcf9;
        border: 1px solid rgba(201,169,89,0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 100;
        transition: all 0.3s;
        font-size: 0.9rem;
        color: var(--dark);
    }

    .modal-close-btn:hover {
        background: var(--primary);
        color: #fff;
        border-color: var(--primary);
        transform: rotate(90deg);
    }

    @media (max-width: 991px) {
        .modal-carousel-panel {
            border-right: none;
            border-bottom: 1px solid rgba(201,169,89,0.15);
        }
        .modal-info {
            padding: 2rem 1.5rem;
            max-height: none;
            overflow-y: visible;
        }
    }

    @media (max-width: 576px) {
        .vet-img-wrap { aspect-ratio: 2/3; }
        .vetements-hero { padding: 2.5rem 0 2rem; }
        .specs-grid { grid-template-columns: 1fr; }
        .process-timeline::before { display: none; }
        .process-timeline { flex-direction: column; gap: 1rem; align-items: flex-start; margin: 1.5rem 0; }
        .timeline-step { width: 100%; display: flex; align-items: center; gap: 1rem; text-align: left; }
        .timeline-dot { margin: 0; }
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
                            @php
                                $adminPhone = \App\Models\Admin::first()?->telephone ?? '221771234567';
                                $waPhone = preg_replace('/\D+/', '', $adminPhone);
                                if (strlen($waPhone) === 9 && (str_starts_with($waPhone, '77') || str_starts_with($waPhone, '78') || str_starts_with($waPhone, '76') || str_starts_with($waPhone, '70') || str_starts_with($waPhone, '75'))) {
                                    $waPhone = '221' . $waPhone;
                                }
                                $absoluteImgUrl = url($cardImgSrc);
                            @endphp
                            <a href="https://wa.me/{{ $waPhone }}?text=Bonjour%20SMC%20Couture,%20je%20souhaite%20commander%20le%20mod%C3%A8le%20{{ urlencode($vetement->nom) }}%20(Prix%20:%20{{ number_format($vetement->prix, 0, ',', ' ') }}%20CFA).%20Voici%20la%20photo%20:%20{{ urlencode($absoluteImgUrl) }}"
                               target="_blank"
                               class="btn-commander-wa">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="margin-right: 5px;">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.713-1.455L0 24zm6.49-3.99c1.65.981 3.272 1.498 4.795 1.5 5.539 0 10.043-4.507 10.046-10.05.001-2.686-1.042-5.212-2.93-7.103-1.89-1.89-4.412-2.932-7.102-2.933-5.546 0-10.05 4.507-10.053 10.051-.002 1.902.501 3.757 1.456 5.416l-.99 3.61 3.712-.973zm12.337-5.69c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                </svg> Commander
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal --}}
            <div class="modal fade" id="vetementModal{{ $vetement->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">

                        <div class="row g-0">
                            {{-- Image Carousel & Thumbnails Panel --}}
                            <div class="col-lg-6 col-md-6 modal-carousel-panel">
                                <div id="carousel-{{ $vetement->id }}" class="carousel slide" data-bs-ride="false">
                                    <div class="carousel-inner">
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
                                            <div class="carousel-img-wrap rounded-4 overflow-hidden">
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
                                    @endif
                                </div>

                                {{-- Vignettes Interactives --}}
                                @if($allModalImages->count() > 1)
                                <div class="d-flex justify-content-center gap-2 mt-3 px-2 flex-wrap">
                                    @foreach($allModalImages as $thumbIndex => $img)
                                    @php
                                        $thumbSrc = str_starts_with($img->image_url, 'http') ? $img->image_url : \Illuminate\Support\Facades\Storage::url($img->image_url);
                                    @endphp
                                    <button type="button" 
                                            data-bs-target="#carousel-{{ $vetement->id }}" 
                                            data-bs-slide-to="{{ $thumbIndex }}" 
                                            class="thumbnail-btn {{ $thumbIndex === 0 ? 'active' : '' }}" 
                                            aria-label="Image {{ $thumbIndex + 1 }}">
                                        <img src="{{ $thumbSrc }}" alt="Vignette {{ $thumbIndex + 1 }}" onerror="this.onerror=null;this.src='{{ $fallbackUrl }}';">
                                    </button>
                                    @endforeach
                                </div>
                                @endif
                            </div>

                            {{-- Info --}}
                            <div class="col-lg-6 col-md-6 modal-info position-relative">
                                <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                                    <i class="fas fa-times"></i>
                                </button>

                                <div class="modal-meta-row">
                                    @if($vetement->categorie)
                                        <span class="modal-cat-badge">
                                            <i class="fas fa-tag fa-xs"></i> {{ $vetement->categorie->nom }}
                                        </span>
                                    @endif
                                    @if($vetement->disponible)
                                        <span class="modal-status-badge">
                                            <i class="fas fa-check-circle fa-xs"></i> Disponible
                                        </span>
                                    @else
                                        <span class="modal-status-badge indispo">
                                            <i class="fas fa-times-circle fa-xs"></i> Sur commande uniquement
                                        </span>
                                    @endif
                                </div>

                                <h3 class="modal-vet-name">{{ $vetement->nom }}</h3>

                                {{-- Prix Block --}}
                                <div class="modal-price-box">
                                    <span class="modal-price-box-label">Prix estimé de confection</span>
                                    <div class="modal-price-box-val">
                                        {{ number_format($vetement->prix, 0, ',', ' ') }} <span class="cfa">CFA</span>
                                    </div>
                                </div>

                                <div class="modal-divider"></div>

                                <h4 class="modal-desc-title">Description du modèle</h4>
                                <p class="modal-desc">{{ $vetement->description ?: 'Aucune description disponible pour ce modèle de création artisanale.' }}</p>



                                <div class="modal-divider"></div>
                                <h4 class="modal-desc-title" style="font-size: 0.95rem; margin-bottom: 0.25rem;">Votre parcours couture</h4>
                                <div class="process-timeline">
                                    <div class="timeline-step">
                                        <div class="timeline-dot">I</div>
                                        <div class="timeline-lbl">Mesures</div>
                                    </div>
                                    <div class="timeline-step">
                                        <div class="timeline-dot">II</div>
                                        <div class="timeline-lbl">Tissus</div>
                                    </div>
                                    <div class="timeline-step">
                                        <div class="timeline-dot">III</div>
                                        <div class="timeline-lbl">Confection</div>
                                    </div>
                                    <div class="timeline-step">
                                        <div class="timeline-dot">IV</div>
                                        <div class="timeline-lbl">Essayage</div>
                                    </div>
                                </div>

                                <div class="modal-actions-container">
                                    @if($vetement->disponible)
                                        <a href="{{ route('rendezvous.create') }}?vetement={{ $vetement->id }}"
                                           class="btn-modal-reserve-premium">
                                            <i class="fas fa-calendar-plus"></i> Prendre RDV Mesures
                                        </a>
                                    @endif
                                </div>
                                <span class="modal-disclaimer">* La prise de rendez-vous est gratuite. Elle comprend une séance de mesures et d'écoute personnalisée à notre atelier.</span>
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
    // ── Search Filter ──
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

    // ── Carousel Thumbnail Synchronization ──
    var carousels = document.querySelectorAll('.modal-carousel-panel .carousel');
    carousels.forEach(function (carousel) {
        carousel.addEventListener('slide.bs.carousel', function (e) {
            var activeIndex = e.to;
            var panel = carousel.closest('.modal-carousel-panel');
            if (panel) {
                var thumbnails = panel.querySelectorAll('.thumbnail-btn');
                thumbnails.forEach(function (btn, index) {
                    if (index === activeIndex) {
                        btn.classList.add('active');
                        // Scroll thumbnail into view if list is overflowed
                        btn.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'nearest' });
                    } else {
                        btn.classList.remove('active');
                    }
                });
            }
        });
    });
});
</script>
@endsection