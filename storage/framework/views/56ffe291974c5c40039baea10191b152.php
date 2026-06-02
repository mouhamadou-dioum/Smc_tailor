<?php $__env->startSection('title', 'Nos Vêtements - Couture App'); ?>

<?php $__env->startSection('styles'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<section class="vetements-hero">
    <div class="container">
        <h1 class="hero-title">Nos Créations</h1>
        <p class="hero-subtitle">Découvrez notre collection exclusive</p>
    </div>
</section>

<section class="py-5" style="background: var(--gray-100);">
    <div class="container">

        
        <div class="filter-box">
            <div class="filter-groups">
                <a href="<?php echo e(route('vetements.index')); ?>"
                   class="filter-btn <?php echo e(!$categorieId ? 'active' : ''); ?>">
                    <i class="fas fa-th-large me-1"></i> Tous
                </a>
                <?php if($categories->count() > 0): ?>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('vetements.index', ['categorie' => $categorie->id])); ?>"
                           class="filter-btn <?php echo e($categorieId == $categorie->id ? 'active' : ''); ?>">
                            <?php echo e($categorie->nom); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>

            <div class="search-input-group">
                <i class="fas fa-search"></i>
                <input type="text" id="vetementSearch" class="search-control" placeholder="Rechercher un modèle...">
            </div>
        </div>

        
        <div class="row g-4" id="vetementsGrid">
            <?php $__empty_1 = true; $__currentLoopData = $vetements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vetement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $allImages = $vetement->images->sortBy('ordre');
                $mainImg = $allImages->first()?->image_url;
                $cardImgSrc = $mainImg
                    ? (str_starts_with($mainImg, 'http') ? $mainImg : \Illuminate\Support\Facades\Storage::url($mainImg))
                    : 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=800';
                $fallbackUrl = 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=800';
            ?>
            <div class="col-md-6 col-lg-4 vetement-item" data-nom="<?php echo e(strtolower($vetement->nom)); ?>" data-desc="<?php echo e(strtolower($vetement->description ?? '')); ?>">
                <div class="vet-card">

                    
                    <div class="vet-img-wrap">
                        <img
                            src="<?php echo e($cardImgSrc); ?>"
                            alt="<?php echo e($vetement->nom); ?>"
                            onerror="this.onerror=null;this.src='<?php echo e($fallbackUrl); ?>';"
                        >

                        
                        <?php if($vetement->categorie): ?>
                            <span class="cat-badge">
                                <i class="fas fa-tag fa-xs"></i> <?php echo e($vetement->categorie->nom); ?>

                            </span>
                        <?php endif; ?>

                        
                        <?php if(!$vetement->disponible): ?>
                            <span class="indispo-badge">Indisponible</span>
                        <?php endif; ?>

                        
                        <span class="price-badge">
                            <?php echo e(number_format($vetement->prix, 0, ',', ' ')); ?>

                            <span class="cfa">CFA</span>
                        </span>
                    </div>

                    
                    <div class="vet-card-body">
                        <h5 class="vet-card-name"><?php echo e($vetement->nom); ?></h5>
                        <p class="vet-card-desc"><?php echo e(\Illuminate\Support\Str::limit($vetement->description ?? '', 85)); ?></p>

                        <div class="vet-card-actions">
                            <button class="btn-detail"
                                    data-bs-toggle="modal"
                                    data-bs-target="#vetementModal<?php echo e($vetement->id); ?>">
                                <i class="fas fa-eye"></i> Détails
                            </button>
                            <?php
                                $adminPhone = \App\Models\Admin::first()?->telephone ?? '221771234567';
                                $waPhone = preg_replace('/\D+/', '', $adminPhone);
                                if (strlen($waPhone) === 9 && (str_starts_with($waPhone, '77') || str_starts_with($waPhone, '78') || str_starts_with($waPhone, '76') || str_starts_with($waPhone, '70') || str_starts_with($waPhone, '75'))) {
                                    $waPhone = '221' . $waPhone;
                                }
                                $absoluteImgUrl = url($cardImgSrc);
                            ?>
                            <a href="https://wa.me/<?php echo e($waPhone); ?>?text=Bonjour%20SMC%20Couture,%20je%20souhaite%20commander%20le%20mod%C3%A8le%20<?php echo e(urlencode($vetement->nom)); ?>%20(Prix%20:%20<?php echo e(number_format($vetement->prix, 0, ',', ' ')); ?>%20CFA).%20Voici%20la%20photo%20:%20<?php echo e(urlencode($absoluteImgUrl)); ?>"
                               target="_blank"
                               class="btn-commander-wa">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 448 512" fill="currentColor" style="margin-right: 5px;">
                                    <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                                </svg> Commander
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="modal fade" id="vetementModal<?php echo e($vetement->id); ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">

                        <div class="row g-0">
                            
                            <div class="col-lg-6 col-md-6 modal-carousel-panel">
                                <div id="carousel-<?php echo e($vetement->id); ?>" class="carousel slide" data-bs-ride="false">
                                    <div class="carousel-inner">
                                        <?php
                                            $allModalImages = $allImages->count() > 0 ? $allImages : collect([
                                                (object)['image_url' => 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=1200']
                                            ]);
                                        ?>
                                        <?php $__currentLoopData = $allModalImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $imgSrc = str_starts_with($img->image_url, 'http') ? $img->image_url : \Illuminate\Support\Facades\Storage::url($img->image_url);
                                        ?>
                                        <div class="carousel-item <?php echo e($index === 0 ? 'active' : ''); ?>">
                                            <div class="carousel-img-wrap rounded-4 overflow-hidden">
                                                <img src="<?php echo e($imgSrc); ?>"
                                                     alt="<?php echo e($vetement->nom); ?> - Image <?php echo e($index + 1); ?>"
                                                     onerror="this.onerror=null;this.src='<?php echo e($fallbackUrl); ?>';">
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>

                                    <?php if($allModalImages->count() > 1): ?>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?php echo e($vetement->id); ?>" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Précédent</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?php echo e($vetement->id); ?>" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Suivant</span>
                                    </button>
                                    <?php endif; ?>
                                </div>

                                
                                <?php if($allModalImages->count() > 1): ?>
                                <div class="d-flex justify-content-center gap-2 mt-3 px-2 flex-wrap">
                                    <?php $__currentLoopData = $allModalImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thumbIndex => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $thumbSrc = str_starts_with($img->image_url, 'http') ? $img->image_url : \Illuminate\Support\Facades\Storage::url($img->image_url);
                                    ?>
                                    <button type="button" 
                                            data-bs-target="#carousel-<?php echo e($vetement->id); ?>" 
                                            data-bs-slide-to="<?php echo e($thumbIndex); ?>" 
                                            class="thumbnail-btn <?php echo e($thumbIndex === 0 ? 'active' : ''); ?>" 
                                            aria-label="Image <?php echo e($thumbIndex + 1); ?>">
                                        <img src="<?php echo e($thumbSrc); ?>" alt="Vignette <?php echo e($thumbIndex + 1); ?>" onerror="this.onerror=null;this.src='<?php echo e($fallbackUrl); ?>';">
                                    </button>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <?php endif; ?>
                            </div>

                            
                            <div class="col-lg-6 col-md-6 modal-info position-relative">
                                <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                                    <i class="fas fa-times"></i>
                                </button>

                                <div class="modal-meta-row">
                                    <?php if($vetement->categorie): ?>
                                        <span class="modal-cat-badge">
                                            <i class="fas fa-tag fa-xs"></i> <?php echo e($vetement->categorie->nom); ?>

                                        </span>
                                    <?php endif; ?>
                                    <?php if($vetement->disponible): ?>
                                        <span class="modal-status-badge">
                                            <i class="fas fa-check-circle fa-xs"></i> Disponible
                                        </span>
                                    <?php else: ?>
                                        <span class="modal-status-badge indispo">
                                            <i class="fas fa-times-circle fa-xs"></i> Sur commande uniquement
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <h3 class="modal-vet-name"><?php echo e($vetement->nom); ?></h3>

                                
                                <div class="modal-price-box">
                                    <span class="modal-price-box-label">Prix estimé de confection</span>
                                    <div class="modal-price-box-val">
                                        <?php echo e(number_format($vetement->prix, 0, ',', ' ')); ?> <span class="cfa">CFA</span>
                                    </div>
                                </div>

                                <div class="modal-divider"></div>

                                <h4 class="modal-desc-title">Description du modèle</h4>
                                <p class="modal-desc"><?php echo e($vetement->description ?: 'Aucune description disponible pour ce modèle de création artisanale.'); ?></p>



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
                                    <?php if($vetement->disponible): ?>
                                        <a href="<?php echo e(route('rendezvous.create')); ?>?vetement=<?php echo e($vetement->id); ?>"
                                           class="btn-modal-reserve-premium">
                                            <i class="fas fa-calendar-plus"></i> Prendre RDV Mesures
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <span class="modal-disclaimer">* La prise de rendez-vous est gratuite. Elle comprend une séance de mesures et d'écoute personnalisée à notre atelier.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="empty-vetements">
                    <i class="fas fa-box-open"></i>
                    <h5 style="font-family:'Playfair Display',serif;color:var(--dark);margin-bottom:0.4rem;">
                        Aucun vêtement disponible
                    </h5>
                    <p class="mb-0">Revenez bientôt pour découvrir nos nouvelles créations.</p>
                </div>
            </div>
            <?php endif; ?>
        </div>

    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\projet laravel\couture-app\resources\views/vetements/index.blade.php ENDPATH**/ ?>