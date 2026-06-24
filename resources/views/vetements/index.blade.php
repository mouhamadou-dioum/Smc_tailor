@extends('layouts.master')

@section('title', config('app.theme_mode') === 'alternative' ? 'Nos Créations - AURA Couture' : 'Nos Vêtements - Couture App')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400&family=Jost:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    /* ═══════════════════════════════════════
       TOKENS
    ═══════════════════════════════════════ */
    :root {
        --gold:        #c9a959;
        --gold-dark:   #a88942;
        --gold-light:  #e8d199;
        --charcoal:    #1a1a2e;
        --charcoal-mid:#2d2d4a;
        --warm-gray:   #6b6760;
        --ivory:       #fdfcf9;
        --ivory-dark:  #f4f0e6;
        --cream:       #F0EBE0;
    }

    /* ═══════════════════════════════════════
       HERO BANNER
    ═══════════════════════════════════════ */
    .vetements-hero {
        background: linear-gradient(145deg, var(--charcoal) 0%, #232342 55%, #1d3450 100%);
        padding: 5rem 0 4rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    /* Orbes lumineux animés */
    .vetements-hero::before,
    .vetements-hero::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
    }
    .vetements-hero::before {
        top: -120px; left: -120px;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(201,169,89,0.12) 0%, transparent 65%);
        animation: orb-drift 10s ease-in-out infinite alternate;
    }
    .vetements-hero::after {
        bottom: -80px; right: -80px;
        width: 380px; height: 380px;
        background: radial-gradient(circle, rgba(99,102,241,0.1) 0%, transparent 65%);
        animation: orb-drift 13s ease-in-out infinite alternate-reverse;
    }
    @keyframes orb-drift {
        from { transform: translate(0, 0) scale(1); }
        to   { transform: translate(40px, 30px) scale(1.12); }
    }

    /* Particules dorées flottantes */
    .hero-particles { position: absolute; inset: 0; pointer-events: none; overflow: hidden; }
    .particle {
        position: absolute;
        width: 2px; height: 2px;
        border-radius: 50%;
        background: var(--gold);
        opacity: 0;
        animation: float-particle linear infinite;
    }
    @keyframes float-particle {
        0%   { transform: translateY(100%) translateX(0); opacity: 0; }
        10%  { opacity: 0.6; }
        90%  { opacity: 0.3; }
        100% { transform: translateY(-100px) translateX(30px); opacity: 0; }
    }

    .hero-eyebrow {
        font-family: 'Jost', sans-serif;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 4px;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
    }
    .hero-eyebrow::before,
    .hero-eyebrow::after {
        content: '';
        width: 30px; height: 1px;
        background: var(--gold);
        opacity: 0.6;
    }

    .hero-title-col {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(2.8rem, 6vw, 4.5rem);
        font-weight: 300;
        color: #fff;
        line-height: 1.1;
        margin-bottom: 0.5rem;
        position: relative;
    }
    .hero-title-col em {
        font-style: italic;
        color: var(--gold-light);
        font-weight: 400;
    }

    .hero-subtitle-col {
        font-family: 'Jost', sans-serif;
        font-size: 1.05rem;
        color: rgba(255,255,255,0.55);
        font-weight: 300;
        margin-bottom: 2.5rem;
        letter-spacing: 0.5px;
    }

    .hero-stats {
        display: inline-flex;
        gap: 2.5rem;
        justify-content: center;
        flex-wrap: wrap;
    }
    .hero-stat {
        text-align: center;
    }
    .hero-stat-num {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem;
        font-weight: 600;
        color: var(--gold);
        line-height: 1;
        display: block;
    }
    .hero-stat-label {
        font-family: 'Jost', sans-serif;
        font-size: 0.65rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: rgba(255,255,255,0.4);
        margin-top: 0.25rem;
        display: block;
    }
    .hero-sep { width: 1px; background: rgba(201,169,89,0.3); }

    /* ═══════════════════════════════════════
       FILTER BAR
    ═══════════════════════════════════════ */
    .collection-section {
        background: linear-gradient(180deg, #f7f5f0 0%, #f2ede3 40%, #f7f5f0 100%);
        padding: 3.5rem 0 5rem;
    }

    .filter-bar {
        background: #fff;
        border-radius: 20px;
        padding: 1rem 1.25rem;
        box-shadow: 0 6px 24px rgba(0,0,0,0.06);
        border: 1px solid rgba(201,169,89,0.12);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 2.5rem;
        position: relative;
    }

    .filter-pills {
        display: flex;
        gap: 0.4rem;
        flex-wrap: wrap;
    }

    .filter-pill {
        font-family: 'Jost', sans-serif;
        padding: 0.45rem 1.1rem;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
        border: 1.5px solid rgba(0,0,0,0.1);
        color: var(--warm-gray);
        background: transparent;
        white-space: nowrap;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }
    .filter-pill:hover {
        border-color: var(--gold);
        color: var(--gold-dark);
        background: rgba(201,169,89,0.06);
        transform: translateY(-1px);
    }
    .filter-pill.active {
        background: linear-gradient(135deg, var(--gold), var(--gold-dark));
        border-color: transparent;
        color: #fff;
        box-shadow: 0 6px 16px rgba(201,169,89,0.38);
        transform: translateY(-1px);
    }
    .filter-pill .pill-count {
        background: rgba(255,255,255,0.25);
        border-radius: 999px;
        padding: 0.05rem 0.45rem;
        font-size: 0.68rem;
        font-weight: 700;
    }
    .filter-pill:not(.active) .pill-count {
        background: rgba(0,0,0,0.06);
    }

    /* Right side controls */
    .filter-controls {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .search-wrap {
        position: relative;
        width: 240px;
    }
    .search-wrap i {
        position: absolute;
        left: 0.9rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gold);
        font-size: 0.8rem;
    }
    .search-input {
        width: 100%;
        padding: 0.5rem 1rem 0.5rem 2.4rem;
        border-radius: 50px;
        border: 1.5px solid rgba(201,169,89,0.2);
        background: #fafaf9;
        font-family: 'Jost', sans-serif;
        font-size: 0.82rem;
        color: var(--charcoal);
        transition: all 0.25s;
    }
    .search-input::placeholder { color: #b5b0a8; }
    .search-input:focus {
        outline: none;
        border-color: var(--gold);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(201,169,89,0.12);
    }

    /* View Toggle */
    .view-toggle {
        display: flex;
        background: #f5f4f2;
        border-radius: 10px;
        padding: 3px;
        gap: 2px;
    }
    .view-btn {
        width: 32px; height: 32px;
        border: none;
        background: transparent;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--warm-gray);
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.85rem;
    }
    .view-btn.active {
        background: #fff;
        color: var(--gold-dark);
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }
    .view-btn:hover:not(.active) { color: var(--gold); }

    /* Results count */
    .results-meta {
        font-family: 'Jost', sans-serif;
        font-size: 0.8rem;
        color: var(--warm-gray);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .results-meta strong { color: var(--charcoal); }

    /* ═══════════════════════════════════════
       GRID & LIST LAYOUT
    ═══════════════════════════════════════ */
    #vetementsGrid {
        transition: all 0.3s ease;
    }

    /* ── GRID MODE ── */
    #vetementsGrid.view-grid .vetement-item {
        /* Bootstrap col-* already handles this */
    }

    /* ── LIST MODE ── */
    #vetementsGrid.view-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    #vetementsGrid.view-list .vetement-item {
        width: 100% !important;
        max-width: 100%;
        flex: none;
    }
    #vetementsGrid.view-list .vet-card {
        flex-direction: row;
        height: auto;
        border-radius: 16px;
    }
    #vetementsGrid.view-list .vet-img-wrap {
        width: 160px;
        min-width: 160px;
        padding-top: 0;
        height: 180px;
        flex-shrink: 0;
        border-radius: 0;
    }
    #vetementsGrid.view-list .vet-card-body {
        flex-direction: row;
        flex-wrap: wrap;
        align-items: center;
        padding: 1.25rem 1.5rem;
        gap: 1rem;
    }
    #vetementsGrid.view-list .vet-card-name {
        font-size: 1.1rem;
        margin-bottom: 0.2rem;
    }
    #vetementsGrid.view-list .vet-card-desc {
        flex: 1 1 auto;
        margin: 0;
    }
    #vetementsGrid.view-list .vet-card-actions {
        flex-direction: column;
        gap: 0.5rem;
        min-width: 140px;
    }

    /* Stagger entry animation */
    .vetement-item {
        animation: card-enter 0.5s ease both;
    }
    @keyframes card-enter {
        from { opacity: 0; transform: translateY(28px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ═══════════════════════════════════════
       CARD DESIGN
    ═══════════════════════════════════════ */
    .vet-card {
        background: #fff;
        border-radius: 28px;
        border: 1.5px solid rgba(201,169,89,0.12);
        box-shadow: 0 6px 28px rgba(0,0,0,0.06), 0 1px 4px rgba(0,0,0,0.04);
        overflow: hidden;
        transition: transform 0.42s cubic-bezier(0.34, 1.56, 0.64, 1),
                    box-shadow 0.3s ease,
                    border-color 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
    }
    .vet-card:hover {
        transform: translateY(-10px) scale(1.012);
        box-shadow: 0 28px 56px rgba(0,0,0,0.13), 0 8px 20px rgba(201,169,89,0.1);
        border-color: rgba(201,169,89,0.4);
    }
    /* Lueur dorée au hover */
    .vet-card::before {
        content: '';
        position: absolute;
        inset: -1px;
        border-radius: 28px;
        background: linear-gradient(135deg, rgba(201,169,89,0.15) 0%, transparent 55%);
        opacity: 0;
        transition: opacity 0.4s ease;
        pointer-events: none;
        z-index: 0;
    }
    .vet-card:hover::before { opacity: 1; }

    /* ── Image Wrapper ── */
    .vet-img-wrap {
        position: relative;
        width: 100%;
        padding-top: 133.33%;
        overflow: hidden;
        background: linear-gradient(145deg, #F5EFE4, #EDE5D6);
        flex-shrink: 0;
    }
    .vet-img-wrap img {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100% !important;
        object-fit: cover;
        object-position: center top;
        transition: transform 0.55s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .vet-card:hover .vet-img-wrap img {
        transform: scale(1.07);
    }

    /* Shimmer overlay on hover */
    .vet-img-wrap::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0) 40%, rgba(255,255,255,0.08) 50%, rgba(255,255,255,0) 60%);
        background-size: 200% 200%;
        opacity: 0;
        transition: opacity 0.3s;
    }
    .vet-card:hover .vet-img-wrap::after {
        opacity: 1;
        animation: shimmer 1.2s ease forwards;
    }
    @keyframes shimmer {
        from { background-position: 200% 200%; }
        to   { background-position: -200% -200%; }
    }

    /* ── New Badge ── */
    .new-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        color: #fff;
        font-family: 'Jost', sans-serif;
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 0.28rem 0.65rem;
        border-radius: 999px;
        z-index: 3;
        box-shadow: 0 4px 10px rgba(238,90,36,0.35);
        animation: pulse-new 2.5s ease-in-out infinite;
    }
    @keyframes pulse-new {
        0%, 100% { box-shadow: 0 4px 10px rgba(238,90,36,0.35); }
        50%       { box-shadow: 0 4px 18px rgba(238,90,36,0.6); }
    }

    /* ── Category Badge ── */
    .cat-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(255,255,255,0.96);
        color: var(--charcoal);
        font-family: 'Jost', sans-serif;
        font-size: 0.62rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 0.3rem 0.85rem;
        border-radius: 999px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.7);
        z-index: 3;
        transition: all 0.28s ease;
        box-shadow: 0 2px 12px rgba(0,0,0,0.1);
    }
    .vet-card:hover .cat-badge {
        background: var(--gold);
        color: #fff;
        border-color: transparent;
        box-shadow: 0 4px 14px rgba(201,169,89,0.35);
    }

    /* ── Indispo Badge ── */
    .indispo-badge {
        position: absolute;
        bottom: 12px;
        right: 12px;
        background: rgba(20,20,20,0.78);
        color: #fff;
        font-family: 'Jost', sans-serif;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 0.3rem 0.75rem;
        border-radius: 999px;
        backdrop-filter: blur(5px);
        z-index: 3;
    }

    /* ── Price Badge (bottom-left of image) ── */
    .price-badge {
        position: absolute;
        bottom: 12px;
        left: 12px;
        background: linear-gradient(135deg, var(--gold), var(--gold-dark));
        color: #fff;
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.05rem;
        font-weight: 700;
        padding: 0.42rem 0.95rem;
        border-radius: 999px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.24);
        letter-spacing: 0.3px;
        display: flex;
        align-items: center;
        gap: 0.3rem;
        z-index: 3;
        transition: transform 0.3s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.3s ease;
    }
    .vet-card:hover .price-badge { transform: scale(1.07); box-shadow: 0 10px 24px rgba(0,0,0,0.3); }
    .price-badge .cfa {
        font-family: 'Jost', sans-serif;
        font-size: 0.62rem;
        font-weight: 700;
        opacity: 0.85;
        letter-spacing: 0.5px;
    }

    /* Quick-view overlay */
    .quick-view-overlay {
        position: absolute;
        inset: 0;
        background: rgba(26,26,46,0.55);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 2;
        backdrop-filter: blur(2px);
    }
    .vet-card:hover .quick-view-overlay { opacity: 1; }
    .quick-view-btn {
        background: rgba(255,255,255,0.96);
        color: var(--charcoal);
        border: none;
        border-radius: 999px;
        padding: 0.7rem 1.6rem;
        font-family: 'Jost', sans-serif;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transform: translateY(12px);
        transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 4px 16px rgba(0,0,0,0.14);
    }
    .vet-card:hover .quick-view-btn { transform: translateY(0); }
    .quick-view-btn:hover {
        background: linear-gradient(135deg, var(--gold), var(--gold-dark));
        color: #fff;
        box-shadow: 0 10px 24px rgba(201,169,89,0.45);
    }

    /* ── Card Body ── */
    .vet-card-body {
        padding: 1.3rem 1.5rem 1.5rem;
        display: flex;
        flex-direction: column;
        flex: 1;
        position: relative;
        z-index: 1;
    }
    .vet-card-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--charcoal);
        margin: 0 0 0.4rem;
        line-height: 1.2;
    }
    .vet-card-desc {
        font-family: 'Jost', sans-serif;
        font-size: 0.8rem;
        color: var(--warm-gray);
        margin: 0 0 1.1rem;
        line-height: 1.6;
        flex: 1;
    }

    /* ── Card Actions ── */
    .vet-card-actions {
        display: flex;
        gap: 0.65rem;
        padding-top: 0.2rem;
    }

    /* Bouton "Détails" */
    .btn-detail {
        flex: 1;
        border: 1.5px solid rgba(201,169,89,0.28);
        color: var(--gold-dark);
        background: rgba(201,169,89,0.06);
        border-radius: 999px;
        padding: 0.65rem 0.8rem;
        font-family: 'Jost', sans-serif;
        font-size: 0.76rem;
        font-weight: 600;
        text-align: center;
        cursor: pointer;
        transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
    }
    .btn-detail::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, var(--gold), var(--gold-dark));
        opacity: 0;
        transition: opacity 0.32s ease;
        border-radius: 999px;
    }
    .btn-detail:hover::before { opacity: 1; }
    .btn-detail:hover {
        border-color: transparent;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(201,169,89,0.42);
    }
    .btn-detail > * { position: relative; z-index: 1; }
    .btn-detail i { transition: transform 0.28s ease; }
    .btn-detail:hover i { transform: scale(1.15); }

    /* Bouton "Commander via WhatsApp" */
    .btn-commander-wa {
        flex: 1;
        background: linear-gradient(135deg, #22c55e, #16a34a);
        color: #fff !important;
        border: none;
        border-radius: 999px;
        padding: 0.65rem 0.8rem;
        font-family: 'Jost', sans-serif;
        font-size: 0.76rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 4px 16px rgba(37,211,102,0.3);
        letter-spacing: 0.5px;
    }
    .btn-commander-wa:hover {
        background: linear-gradient(135deg, #16a34a, #15803d);
        color: #fff !important;
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(37,211,102,0.45);
    }

    /* ═══════════════════════════════════════
       EMPTY STATE
    ═══════════════════════════════════════ */
    .empty-vetements {
        background: #fff;
        border-radius: 24px;
        border: 1.5px dashed rgba(201,169,89,0.3);
        padding: 6rem 2rem;
        text-align: center;
        color: var(--warm-gray);
    }
    .empty-vetements .empty-icon {
        width: 90px; height: 90px;
        background: rgba(201,169,89,0.08);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2.2rem;
        color: var(--gold);
    }
    .empty-vetements h5 {
        font-family: 'Cormorant Garamond', serif;
        color: var(--charcoal);
        font-size: 1.4rem;
        margin-bottom: 0.5rem;
    }

    /* ═══════════════════════════════════════
       MODAL PREMIUM
    ═══════════════════════════════════════ */
    .modal-content {
        border: 1px solid rgba(201,169,89,0.2);
        border-radius: 26px;
        overflow: hidden;
        box-shadow: 0 30px 70px rgba(0,0,0,0.28);
        background: var(--ivory);
    }
    .modal-body { padding: 0; }

    .modal-carousel-panel {
        background: var(--ivory-dark);
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 1.75rem;
        border-right: 1px solid rgba(201,169,89,0.12);
    }
    .modal-carousel {
        width: 100%;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 12px 32px rgba(0,0,0,0.1);
        border: 1px solid rgba(201,169,89,0.15);
    }
    .carousel-img-wrap {
        aspect-ratio: 3/4;
        position: relative;
        background: var(--cream);
    }
    .carousel-img-wrap img {
        width: 100%; height: 100%;
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
    .modal-carousel:hover .carousel-control-next { opacity: 1; }
    .modal-carousel .carousel-control-prev-icon,
    .modal-carousel .carousel-control-next-icon {
        background-color: rgba(26,26,26,0.75);
        border-radius: 50%;
        padding: 1rem;
        background-size: 40%;
        border: 1px solid rgba(201,169,89,0.3);
    }

    /* Vignettes */
    .thumbnail-btn {
        width: 58px; height: 78px;
        padding: 0;
        border: 2px solid transparent;
        border-radius: 9px;
        overflow: hidden;
        background: transparent;
        transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
        cursor: pointer;
    }
    .thumbnail-btn img { width: 100%; height: 100%; object-fit: cover; object-position: center top; }
    .thumbnail-btn:hover { border-color: var(--gold); transform: translateY(-3px); }
    .thumbnail-btn.active {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(201,169,89,0.3);
        transform: translateY(-3px);
    }

    /* Info Panel */
    .modal-info {
        padding: 2.5rem 2.25rem;
        display: flex;
        flex-direction: column;
        max-height: 85vh;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: rgba(201,169,89,0.3) transparent;
    }
    .modal-close-btn {
        position: absolute;
        top: 18px; right: 18px;
        width: 36px; height: 36px;
        border-radius: 50%;
        background: rgba(255,255,255,0.9);
        border: 1px solid rgba(201,169,89,0.25);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        z-index: 100;
        transition: all 0.3s;
        font-size: 0.88rem;
        color: var(--charcoal);
        backdrop-filter: blur(4px);
    }
    .modal-close-btn:hover {
        background: var(--gold);
        color: #fff;
        border-color: var(--gold);
        transform: rotate(90deg);
    }

    .modal-cat-badge {
        display: inline-flex; align-items: center; gap: 0.35rem;
        background: rgba(201,169,89,0.1);
        border: 1px solid rgba(201,169,89,0.25);
        color: var(--gold-dark);
        font-family: 'Jost', sans-serif;
        font-size: 0.65rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: 1.5px;
        padding: 0.32rem 0.8rem;
        border-radius: 999px;
    }
    .modal-status-badge {
        display: inline-flex; align-items: center; gap: 0.35rem;
        background: rgba(16,185,129,0.1);
        border: 1px solid rgba(16,185,129,0.2);
        color: #065f46;
        font-family: 'Jost', sans-serif;
        font-size: 0.65rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: 0.8px;
        padding: 0.32rem 0.8rem;
        border-radius: 999px;
    }
    .modal-status-badge.indispo {
        background: rgba(239,68,68,0.1);
        border-color: rgba(239,68,68,0.2);
        color: #991b1b;
    }

    .modal-vet-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.1rem;
        font-weight: 400;
        color: var(--charcoal);
        margin: 0.75rem 0 1rem;
        line-height: 1.15;
        padding-right: 2rem;
    }

    .modal-price-box {
        background: linear-gradient(135deg, rgba(201,169,89,0.08), rgba(201,169,89,0.03));
        border: 1.5px solid rgba(201,169,89,0.25);
        border-radius: 14px;
        padding: 0.9rem 1.3rem;
        width: fit-content;
        margin-bottom: 1.5rem;
    }
    .modal-price-box-label {
        font-family: 'Jost', sans-serif;
        font-size: 0.58rem;
        text-transform: uppercase; letter-spacing: 2.5px;
        color: var(--gold-dark);
        font-weight: 600;
        margin-bottom: 0.2rem;
        display: block;
    }
    .modal-price-box-val {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.9rem;
        font-weight: 600;
        color: var(--gold-dark);
        line-height: 1;
        display: flex; align-items: baseline; gap: 0.35rem;
    }
    .modal-price-box-val .cfa { font-family: 'Jost', sans-serif; font-size: 0.9rem; font-weight: 700; }

    .modal-divider {
        height: 1px;
        background: linear-gradient(to right, rgba(201,169,89,0.25), rgba(201,169,89,0.04));
        margin: 1.25rem 0;
    }
    .modal-desc-title {
        font-family: 'Jost', sans-serif;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--warm-gray);
        margin-bottom: 0.5rem;
    }
    .modal-desc {
        font-family: 'Jost', sans-serif;
        font-size: 0.86rem;
        color: var(--warm-gray);
        line-height: 1.78;
        margin-bottom: 0;
    }

    /* Specs grid */
    .specs-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }
    .spec-item {
        display: flex;
        gap: 0.65rem;
        align-items: flex-start;
        padding: 0.8rem;
        background: rgba(245,244,242,0.8);
        border-radius: 12px;
        border: 1px solid rgba(201,169,89,0.12);
        transition: transform 0.25s;
    }
    .spec-item:hover { transform: translateY(-2px); }
    .spec-item i { font-size: 1rem; color: var(--gold); margin-top: 0.1rem; }
    .spec-item-label { font-family: 'Jost', sans-serif; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 1px; color: var(--warm-gray); font-weight: 600; margin-bottom: 0.12rem; line-height: 1; }
    .spec-item-value { font-family: 'Jost', sans-serif; font-size: 0.8rem; font-weight: 500; color: var(--charcoal); }

    /* Timeline */
    .process-timeline {
        display: flex; justify-content: space-between;
        position: relative;
        margin: 1.5rem 0;
        padding: 0.5rem 0 0.75rem;
    }
    .process-timeline::before {
        content: '';
        position: absolute;
        top: 21px; left: 10%; right: 10%;
        height: 1px;
        background: linear-gradient(to right, transparent, rgba(201,169,89,0.35) 20%, rgba(201,169,89,0.35) 80%, transparent);
        z-index: 1;
    }
    .timeline-step { position: relative; z-index: 2; text-align: center; width: 22%; }
    .timeline-dot {
        width: 32px; height: 32px;
        border-radius: 50%;
        border: 1.5px solid var(--gold);
        background: var(--ivory);
        display: flex; align-items: center; justify-content: center;
        font-family: 'Cormorant Garamond', serif;
        font-size: 0.88rem; color: var(--gold);
        margin: 0 auto 0.5rem;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .timeline-step:hover .timeline-dot {
        background: var(--gold);
        color: #fff;
        transform: scale(1.15);
        box-shadow: 0 0 10px rgba(201,169,89,0.45);
    }
    .timeline-lbl { font-family: 'Jost', sans-serif; font-size: 0.62rem; color: var(--warm-gray); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }

    /* Modal action buttons */
    .modal-actions-container { display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap; margin-top: 1.5rem; }

    .btn-modal-reserve-premium {
        flex-grow: 1;
        background: linear-gradient(135deg, var(--charcoal), #2a2a3a);
        color: var(--gold-light) !important;
        border: 1.5px solid var(--gold);
        border-radius: 999px;
        padding: 0.9rem 1.75rem;
        font-family: 'Jost', sans-serif;
        font-size: 0.72rem; font-weight: 600;
        letter-spacing: 2px; text-transform: uppercase;
        transition: all 0.38s cubic-bezier(0.34, 1.56, 0.64, 1);
        display: inline-flex; align-items: center; justify-content: center; gap: 0.7rem;
        text-decoration: none;
        box-shadow: 0 4px 16px rgba(0,0,0,0.14);
        position: relative;
        overflow: hidden;
    }
    .btn-modal-reserve-premium::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, var(--gold), var(--gold-dark));
        opacity: 0;
        transition: opacity 0.35s ease;
        border-radius: 999px;
    }
    .btn-modal-reserve-premium:hover::before { opacity: 1; }
    .btn-modal-reserve-premium:hover {
        background: transparent;
        color: var(--charcoal) !important;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 10px 26px rgba(201,169,89,0.4);
    }
    .btn-modal-reserve-premium > * { position: relative; z-index: 1; }

    .btn-modal-whatsapp {
        background: transparent;
        color: #25d366 !important;
        border: 1.5px solid #25d366;
        border-radius: 999px;
        padding: 0.9rem 1.5rem;
        font-family: 'Jost', sans-serif;
        font-size: 0.72rem; font-weight: 600;
        letter-spacing: 2px; text-transform: uppercase;
        transition: all 0.38s cubic-bezier(0.34, 1.56, 0.64, 1);
        display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;
        text-decoration: none;
    }
    .btn-modal-whatsapp:hover {
        background: linear-gradient(135deg, #22c55e, #16a34a);
        color: #fff !important;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(37,211,102,0.38);
    }

    .modal-disclaimer { font-family: 'Jost', sans-serif; font-size: 0.7rem; color: var(--warm-gray); margin-top: 1rem; display: block; line-height: 1.5; }

    /* ═══════════════════════════════════════
       RESPONSIVE
    ═══════════════════════════════════════ */
    @media (max-width: 991px) {
        .modal-carousel-panel { border-right: none; border-bottom: 1px solid rgba(201,169,89,0.12); }
        .modal-info { padding: 2rem 1.5rem; max-height: none; overflow-y: visible; }
        .search-wrap { width: 180px; }
    }
    @media (max-width: 768px) {
        .filter-bar { flex-direction: column; align-items: stretch; }
        .filter-controls { width: 100%; }
        .search-wrap { width: 100%; flex: 1; }
        .hero-sep { display: none; }
        .vetements-hero { padding: 3.5rem 0 3rem; }
        #vetementsGrid.view-list .vet-img-wrap { width: 130px; min-width: 130px; height: 160px; }
    }
    @media (max-width: 576px) {
        .vetements-hero { padding: 2.5rem 0 2rem; }
        .specs-grid { grid-template-columns: 1fr; }
        .process-timeline::before { display: none; }
        .process-timeline { flex-direction: column; gap: 0.75rem; align-items: flex-start; }
        .timeline-step { width: 100%; display: flex; align-items: center; gap: 1rem; text-align: left; }
        .timeline-dot { margin: 0; }
        .hero-stats { gap: 1.5rem; }
        #vetementsGrid.view-list .vet-card { flex-direction: column; }
        #vetementsGrid.view-list .vet-img-wrap { width: 100%; height: auto; padding-top: 70%; }
    }
</style>
@endsection

@section('content')

{{-- ════════════════════════════════
     HERO BANNER
════════════════════════════════ --}}
<section class="vetements-hero">
    {{-- Particules --}}
    <div class="hero-particles" id="heroParticles"></div>

    <div class="container" style="position:relative; z-index:2;">
        <p class="hero-eyebrow">
            @if(config('app.theme_mode') === 'alternative') AURA Couture @else SMC Couture @endif
        </p>

        @if(config('app.theme_mode') === 'alternative')
            <h1 class="hero-title-col">Collection <em>d'Exception</em></h1>
            <p class="hero-subtitle-col">Élégance à l'état pur — chaque pièce, une œuvre</p>
        @else
            <h1 class="hero-title-col">Nos <em>Créations</em></h1>
            <p class="hero-subtitle-col">Découvrez notre collection de vêtements sur mesure</p>
        @endif

        <div class="hero-stats">
            <div class="hero-stat">
                <span class="hero-stat-num" id="heroCountTotal">{{ $vetements->count() }}</span>
                <span class="hero-stat-label">Pièces</span>
            </div>
            <div class="hero-sep d-none d-md-block"></div>
            <div class="hero-stat">
                <span class="hero-stat-num">{{ $categories->count() }}</span>
                <span class="hero-stat-label">Catégories</span>
            </div>
            <div class="hero-sep d-none d-md-block"></div>
            <div class="hero-stat">
                <span class="hero-stat-num">100%</span>
                <span class="hero-stat-label">Sur mesure</span>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════
     COLLECTION SECTION
════════════════════════════════ --}}
<section class="collection-section">
    <div class="container">

        {{-- Filter Bar --}}
        <div class="filter-bar">
            {{-- Catégories --}}
            <div class="filter-pills">
                <a href="{{ route('vetements.index') }}"
                   class="filter-pill {{ !$categorieId ? 'active' : '' }}">
                    <i class="fas fa-th-large" style="font-size:0.7rem;"></i>
                    Tous
                    <span class="pill-count">{{ $vetements->count() }}</span>
                </a>
                @foreach($categories as $categorie)
                    @php $catCount = $vetements->where('categorie_id', $categorie->id)->count(); @endphp
                    <a href="{{ route('vetements.index', ['categorie' => $categorie->id]) }}"
                       class="filter-pill {{ $categorieId == $categorie->id ? 'active' : '' }}">
                        {{ $categorie->nom }}
                        <span class="pill-count">{{ $catCount }}</span>
                    </a>
                @endforeach
            </div>

            {{-- Controls (Search + View Toggle) --}}
            <div class="filter-controls">
                <div class="search-wrap">
                    <i class="fas fa-search"></i>
                    <input type="text"
                           id="vetementSearch"
                           class="search-input"
                           placeholder="Rechercher…"
                           autocomplete="off">
                </div>

                <div class="view-toggle" title="Changer de vue">
                    <button class="view-btn active" id="viewGrid" title="Grille">
                        <i class="fas fa-grip-vertical"></i>
                    </button>
                    <button class="view-btn" id="viewList" title="Liste">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Results meta --}}
        <div class="results-meta" id="resultsMeta">
            <i class="fas fa-layer-group" style="color:var(--gold); font-size:0.75rem;"></i>
            <strong id="visibleCount">{{ $vetements->count() }}</strong>
            pièce{{ $vetements->count() > 1 ? 's' : '' }} trouvée{{ $vetements->count() > 1 ? 's' : '' }}
        </div>

        {{-- Grid --}}
        <div class="row g-4 view-grid" id="vetementsGrid">
            @forelse($vetements as $vetement)
            @php
                $altImages = [
                    'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=800',
                    'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=800',
                    'https://images.unsplash.com/photo-1539109136881-3be0616acf4b?w=800',
                    'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=800',
                    'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=800',
                    'https://images.unsplash.com/photo-1509631179647-0177331693ae?w=800',
                ];
                $altNames = [
                    'Le Tailleur Émeraude',
                    'La Robe de Soirée Velours',
                    'Le Costume Tuxedo Impérial',
                    'La Robe en Soie de Nuit',
                    'L\'Ensemble Prestige Lin',
                    'Le Manteau Laine Cachemire',
                ];
                $altDescs = [
                    'Un tailleur d\'une élégance incomparable, ajusté avec soin pour une silhouette moderne et distinguée.',
                    'Une robe de soirée somptueuse en velours de soie, conçue pour capter la lumière lors des grands événements.',
                    'Le costume de cérémonie par excellence. Un smoking intemporel à la coupe ajustée et finitions faites main.',
                    'Une création fluide et aérienne en soie naturelle, offrant un confort absolu et un port altier.',
                    'Un ensemble raffiné alliant modernité et tradition, confectionné dans un lin d\'exception.',
                    'Un pardessus haut de gamme en laine vierge et cachemire, pièce maîtresse du vestiaire d\'hiver.',
                ];
                $index = $loop->index % 6;
                if (config('app.theme_mode') === 'alternative') {
                    $nom = $altNames[$index];
                    $desc = $altDescs[$index];
                    $cardImgSrc = $altImages[$index];
                } else {
                    $nom = $vetement->nom;
                    $desc = $vetement->description;
                    $allImages = $vetement->images->sortBy('ordre');
                    $mainImg = $allImages->first()?->image_url;
                    $cardImgSrc = $mainImg
                        ? (str_starts_with($mainImg, 'http') ? $mainImg : \Illuminate\Support\Facades\Storage::url($mainImg))
                        : 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=800';
                }
                $fallbackUrl = 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=800';
                $isNew = $vetement->created_at >= now()->subDays(14);
            @endphp

            <div class="col-md-6 col-lg-4 vetement-item"
                 data-nom="{{ strtolower($nom) }}"
                 data-desc="{{ strtolower($desc ?? '') }}"
                 style="animation-delay: {{ ($loop->index % 6) * 0.08 }}s">

                <div class="vet-card">

                    {{-- Image --}}
                    <div class="vet-img-wrap">
                        <img
                            src="{{ $cardImgSrc }}"
                            alt="{{ $nom }}"
                            onerror="this.onerror=null;this.src='{{ $fallbackUrl }}';"
                            loading="{{ $loop->index < 6 ? 'eager' : 'lazy' }}"
                        >

                        {{-- Badges --}}
                        @if($vetement->categorie)
                            <span class="cat-badge">
                                <i class="fas fa-tag fa-xs"></i> {{ $vetement->categorie->nom }}
                            </span>
                        @endif

                        @if($isNew && $vetement->disponible)
                            <span class="new-badge">Nouveau</span>
                        @elseif(!$vetement->disponible)
                            <span class="indispo-badge">Sur commande</span>
                        @endif

                        @if($vetement->disponible)
                            <span class="price-badge">
                                {{ number_format($vetement->prix, 0, ',', ' ') }}
                                <span class="cfa">CFA</span>
                            </span>
                        @endif

                        {{-- Quick-view overlay --}}
                        <div class="quick-view-overlay">
                            <button class="quick-view-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#vetementModal{{ $vetement->id }}">
                                <i class="fas fa-eye"></i> Aperçu rapide
                            </button>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="vet-card-body">
                        <h5 class="vet-card-name">{{ $nom }}</h5>
                        <p class="vet-card-desc">{{ \Illuminate\Support\Str::limit($desc ?? '', 90) }}</p>

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
                                $waText = config('app.theme_mode') === 'alternative'
                                    ? "Bonjour AURA Couture, je souhaite commander le modèle " . $nom . " (Prix : " . number_format($vetement->prix, 0, ',', ' ') . " CFA). Voici la photo : " . $absoluteImgUrl
                                    : "Bonjour SMC Couture, je souhaite commander le modèle " . $vetement->nom . " (Prix : " . number_format($vetement->prix, 0, ',', ' ') . " CFA). Voici la photo : " . $absoluteImgUrl;
                            @endphp
                            <a href="https://wa.me/{{ $waPhone }}?text={{ urlencode($waText) }}"
                               target="_blank"
                               class="btn-commander-wa">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.713-1.455L0 24zm6.49-3.99c1.65.981 3.272 1.498 4.795 1.5 5.539 0 10.043-4.507 10.046-10.05.001-2.686-1.042-5.212-2.93-7.103-1.89-1.89-4.412-2.932-7.102-2.933-5.546 0-10.05 4.507-10.053 10.051-.002 1.902.501 3.757 1.456 5.416l-.99 3.61 3.712-.973zm12.337-5.69c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                                Commander
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ════ MODAL ════ --}}
            <div class="modal fade" id="vetementModal{{ $vetement->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="row g-0">

                            {{-- Carousel Panel --}}
                            <div class="col-lg-6 col-md-6 modal-carousel-panel">
                                <div id="carousel-{{ $vetement->id }}" class="modal-carousel carousel slide" data-bs-ride="false">
                                    <div class="carousel-inner">
                                        @php
                                            if (config('app.theme_mode') === 'alternative') {
                                                $allModalImages = collect([(object)['image_url' => $cardImgSrc]]);
                                            } else {
                                                $allModalImages = $allImages->count() > 0 ? $allImages : collect([
                                                    (object)['image_url' => 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=1200']
                                                ]);
                                            }
                                        @endphp
                                        @foreach($allModalImages as $indexImg => $img)
                                        @php
                                            $imgSrc = str_starts_with($img->image_url, 'http') ? $img->image_url : \Illuminate\Support\Facades\Storage::url($img->image_url);
                                        @endphp
                                        <div class="carousel-item {{ $indexImg === 0 ? 'active' : '' }}">
                                            <div class="carousel-img-wrap rounded-4 overflow-hidden">
                                                <img src="{{ $imgSrc }}"
                                                     alt="{{ $nom }} - Image {{ $indexImg + 1 }}"
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

                                @if($allModalImages->count() > 1)
                                <div class="d-flex justify-content-center gap-2 mt-3 px-2 flex-wrap">
                                    @foreach($allModalImages as $thumbIndex => $img)
                                    @php $thumbSrc = str_starts_with($img->image_url, 'http') ? $img->image_url : \Illuminate\Support\Facades\Storage::url($img->image_url); @endphp
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

                            {{-- Info Panel --}}
                            <div class="col-lg-6 col-md-6 modal-info position-relative">
                                <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                                    <i class="fas fa-times"></i>
                                </button>

                                {{-- Meta --}}
                                <div class="d-flex align-items-center gap-2 flex-wrap">
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
                                            <i class="fas fa-circle fa-xs"></i> Sur commande
                                        </span>
                                    @endif
                                </div>

                                <h3 class="modal-vet-name">{{ $nom }}</h3>

                                {{-- Prix --}}
                                <div class="modal-price-box">
                                    <span class="modal-price-box-label">Tarif estimé</span>
                                    <div class="modal-price-box-val">
                                        {{ number_format($vetement->prix, 0, ',', ' ') }}
                                        <span class="cfa">CFA</span>
                                    </div>
                                </div>

                                <div class="modal-divider"></div>

                                {{-- Description --}}
                                <p class="modal-desc-title">Description du modèle</p>
                                <p class="modal-desc">{{ $desc ?: 'Aucune description disponible pour ce modèle de création artisanale.' }}</p>

                                <div class="modal-divider" style="margin: 1rem 0 1.25rem;"></div>

                                {{-- Specs --}}
                                <p class="modal-desc-title">Caractéristiques</p>
                                <div class="specs-grid">
                                    <div class="spec-item">
                                        <i class="fas fa-coins"></i>
                                        <div>
                                            <div class="spec-item-label">Prix</div>
                                            <div class="spec-item-value">{{ number_format($vetement->prix, 0, ',', ' ') }} CFA</div>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <div>
                                            <div class="spec-item-label">Origine</div>
                                            <div class="spec-item-value">Dakar, Sénégal</div>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <i class="fas fa-cut"></i>
                                        <div>
                                            <div class="spec-item-label">Type</div>
                                            <div class="spec-item-value">Sur mesure</div>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <i class="fas fa-hourglass-half"></i>
                                        <div>
                                            <div class="spec-item-label">Délai</div>
                                            <div class="spec-item-value">2 – 4 semaines</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Timeline --}}
                                <p class="modal-desc-title">Votre parcours couture</p>
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

                                {{-- CTA Buttons --}}
                                <div class="modal-actions-container">
                                    @if($vetement->disponible)
                                        <a href="{{ route('rendezvous.create') }}?vetement={{ $vetement->id }}"
                                           class="btn-modal-reserve-premium">
                                            <i class="fas fa-calendar-plus"></i> Prendre RDV
                                        </a>
                                    @endif
                                    <a href="https://wa.me/{{ $waPhone }}?text={{ urlencode($waText) }}"
                                       target="_blank"
                                       class="btn-modal-whatsapp">
                                        <i class="fab fa-whatsapp" style="font-size:1rem;"></i> Commander
                                    </a>
                                </div>
                                <span class="modal-disclaimer">
                                    * La prise de rendez-vous est gratuite. Elle comprend une séance de mesures et d'écoute personnalisée à notre atelier.
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{-- END MODAL --}}

            @empty
            <div class="col-12">
                <div class="empty-vetements">
                    <div class="empty-icon">
                        <i class="fas fa-shirt"></i>
                    </div>
                    <h5>Aucun vêtement disponible</h5>
                    <p class="mb-0" style="font-family:'Jost',sans-serif; font-size:0.9rem;">
                        Revenez bientôt pour découvrir nos nouvelles créations.
                    </p>
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

    /* ── Particules dorées dans le hero ── */
    (function spawnParticles() {
        var container = document.getElementById('heroParticles');
        if (!container) return;
        for (var i = 0; i < 30; i++) {
            var p = document.createElement('span');
            p.className = 'particle';
            var size = Math.random() * 3 + 1;
            p.style.cssText = [
                'left:' + (Math.random() * 100) + '%',
                'top:' + (Math.random() * 100) + '%',
                'width:' + size + 'px',
                'height:' + size + 'px',
                'animation-duration:' + (Math.random() * 10 + 8) + 's',
                'animation-delay:' + (Math.random() * 8) + 's',
                'opacity:' + (Math.random() * 0.5 + 0.1)
            ].join(';');
            container.appendChild(p);
        }
    })();

    /* ── Stagger d'entrée animée ── */
    var items = document.querySelectorAll('.vetement-item');

    /* ── Search ── */
    var searchInput = document.getElementById('vetementSearch');
    var resultsMeta = document.getElementById('resultsMeta');
    var visibleCount = document.getElementById('visibleCount');

    function updateResults() {
        var visible = 0;
        items.forEach(function(item) {
            if (item.style.display !== 'none') visible++;
        });
        if (visibleCount) visibleCount.textContent = visible;
    }

    if (searchInput) {
        searchInput.addEventListener('input', function (e) {
            var val = e.target.value.toLowerCase().trim();
            items.forEach(function (item) {
                var nom  = item.getAttribute('data-nom')  || '';
                var desc = item.getAttribute('data-desc') || '';
                var show = !val || nom.includes(val) || desc.includes(val);
                item.style.display = show ? '' : 'none';
            });
            updateResults();
        });
    }

    /* ── View Toggle (Grille / Liste) ── */
    var grid     = document.getElementById('vetementsGrid');
    var btnGrid  = document.getElementById('viewGrid');
    var btnList  = document.getElementById('viewList');

    function setView(mode) {
        if (mode === 'list') {
            grid.classList.remove('view-grid', 'row', 'g-4');
            grid.classList.add('view-list');
            btnGrid.classList.remove('active');
            btnList.classList.add('active');
            localStorage.setItem('vetView', 'list');
        } else {
            grid.classList.remove('view-list');
            grid.classList.add('view-grid', 'row', 'g-4');
            btnGrid.classList.add('active');
            btnList.classList.remove('active');
            localStorage.setItem('vetView', 'grid');
        }
    }

    // Restore saved preference
    var savedView = localStorage.getItem('vetView');
    if (savedView === 'list') setView('list');

    if (btnGrid) btnGrid.addEventListener('click', function() { setView('grid'); });
    if (btnList) btnList.addEventListener('click', function() { setView('list'); });

    /* ── Carousel Thumbnail Sync ── */
    document.querySelectorAll('.modal-carousel-panel .carousel').forEach(function (carousel) {
        carousel.addEventListener('slide.bs.carousel', function (e) {
            var activeIndex = e.to;
            var panel = carousel.closest('.modal-carousel-panel');
            if (panel) {
                panel.querySelectorAll('.thumbnail-btn').forEach(function (btn, idx) {
                    btn.classList.toggle('active', idx === activeIndex);
                    if (idx === activeIndex) btn.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'nearest' });
                });
            }
        });
    });

});
</script>
@endsection