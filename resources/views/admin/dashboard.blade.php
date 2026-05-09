@extends('layouts.master')

@section('title', 'Admin - Tableau de bord')

@section('styles')
<style>
    /* ── Page ── */
    .dashboard-page {
        padding: 2.5rem 0 5rem;
        min-height: calc(100vh - 200px);
        background: var(--gray-100);
    }

    /* ── Hero Header ── */
    .dash-hero {
        background: linear-gradient(135deg, var(--dark) 0%, #252545 60%, #1f3a52 100%);
        border-radius: 24px;
        padding: 2rem 2.5rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        box-shadow: 0 12px 40px rgba(26,26,46,0.22);
        position: relative;
        overflow: hidden;
    }

    .dash-hero::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -5%;
        width: 320px;
        height: 320px;
        background: radial-gradient(circle, rgba(201,169,89,0.18) 0%, transparent 70%);
        pointer-events: none;
    }

    .dash-hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .dash-hero-title i { color: var(--primary); }

    .dash-hero-sub {
        color: rgba(255,255,255,0.5);
        font-size: 0.875rem;
        margin: 0;
    }

    .dash-hero-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        align-items: center;
    }

    .btn-hero-primary {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 0.55rem 1.25rem;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.25s;
        box-shadow: 0 4px 12px rgba(201,169,89,0.3);
        white-space: nowrap;
    }

    .btn-hero-primary:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(201,169,89,0.4);
    }

    /* ── Stat Cards ── */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .stat-card-new {
        background: #fff;
        border-radius: 18px;
        border: 1.5px solid var(--gray-200);
        padding: 1.4rem 1.5rem;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card-new::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        border-radius: 0 0 18px 18px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .stat-card-new:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 28px rgba(0,0,0,0.1);
    }

    .stat-card-new:hover::after { opacity: 1; }

    .stat-card-new.gold::after   { background: var(--primary); }
    .stat-card-new.indigo::after { background: #6366f1; }
    .stat-card-new.teal::after   { background: #0d9488; }
    .stat-card-new.amber::after  { background: #f59e0b; }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .stat-icon.gold   { background: rgba(201,169,89,0.12); color: var(--primary); }
    .stat-icon.indigo { background: rgba(99,102,241,0.12); color: #6366f1; }
    .stat-icon.teal   { background: rgba(13,148,136,0.12); color: #0d9488; }
    .stat-icon.amber  { background: rgba(245,158,11,0.12); color: #f59e0b; }

    .stat-body { min-width: 0; }

    .stat-value {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        font-weight: 700;
        color: var(--dark);
        line-height: 1;
        margin-bottom: 0.2rem;
    }

    .stat-label {
        font-size: 0.78rem;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    /* ── Section Cards ── */
    .section-card {
        background: #fff;
        border-radius: 18px;
        border: 1.5px solid var(--gray-200);
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        overflow: hidden;
        height: 100%;
    }

    .section-card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1.5px solid var(--gray-200);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
    }

    .section-card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-card-title i { color: var(--primary); }

    .btn-see-all {
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--primary);
        text-decoration: none;
        border: 1px solid rgba(201,169,89,0.35);
        border-radius: 8px;
        padding: 0.3rem 0.75rem;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .btn-see-all:hover {
        background: var(--primary);
        color: #fff;
        border-color: var(--primary);
    }

    .section-card-body { padding: 1rem 1.25rem; }

    /* ── Vetement Row ── */
    .vet-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem 0.5rem;
        border-radius: 12px;
        transition: background 0.2s;
        gap: 0.75rem;
    }

    .vet-row:hover { background: var(--gray-100); }

    .vet-row + .vet-row {
        border-top: 1px solid var(--gray-200);
    }

    .vet-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: rgba(201,169,89,0.1);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
    }

    .vet-name {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0 0 0.1rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 160px;
    }

    .vet-price {
        font-size: 0.75rem;
        color: var(--gray-500);
        margin: 0;
    }

    .dispo-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.25rem 0.65rem;
        border-radius: 999px;
        font-size: 0.7rem;
        font-weight: 600;
        flex-shrink: 0;
    }

    .dispo-pill.yes { background: #d4edda; color: #155724; }
    .dispo-pill.no  { background: #f8d7da; color: #721c24; }

    /* ── RDV Row ── */
    .rdv-row {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 0.5rem;
        border-radius: 12px;
        transition: background 0.2s;
    }

    .rdv-row:hover { background: var(--gray-100); }

    .rdv-row + .rdv-row {
        border-top: 1px solid var(--gray-200);
    }

    .rdv-row-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Playfair Display', serif;
        font-size: 0.8rem;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
    }

    .rdv-row-info { flex: 1; min-width: 0; }

    .rdv-row-name {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0 0 0.1rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .rdv-row-date {
        font-size: 0.72rem;
        color: var(--gray-500);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .rdv-row-actions {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-shrink: 0;
    }

    .status-dot {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.25rem 0.65rem;
        border-radius: 999px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .status-dot.confirme { background: #d4edda; color: #155724; }
    .status-dot.attente  { background: #fff3cd; color: #856404; }
    .status-dot.refuse   { background: #f8d7da; color: #721c24; }

    .btn-eye {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        background: rgba(201,169,89,0.1);
        color: var(--primary-dark);
        border: 1px solid rgba(201,169,89,0.25);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        text-decoration: none;
        transition: all 0.2s;
        flex-shrink: 0;
    }

    .btn-eye:hover {
        background: var(--primary);
        color: #fff;
        transform: scale(1.1);
    }

    /* ── Left accent border ── */
    .accent-confirme { border-left: 3px solid #28a745; padding-left: 0.6rem !important; }
    .accent-attente  { border-left: 3px solid #f59e0b; padding-left: 0.6rem !important; }
    .accent-refuse   { border-left: 3px solid #dc3545; padding-left: 0.6rem !important; }

    /* ── Responsive ── */
    @media (max-width: 991px) {
        .stats-row { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 576px) {
        .stats-row { grid-template-columns: repeat(2, 1fr); gap: 0.75rem; }
        .dash-hero { padding: 1.25rem; border-radius: 16px; }
        .dash-hero-title { font-size: 1.35rem; }
        .stat-value { font-size: 1.6rem; }
    }
</style>
@endsection

@section('content')
<div class="dashboard-page">
    <div class="container">

        {{-- Hero Header --}}
        <div class="dash-hero">
            <div>
                <h1 class="dash-hero-title">
                    <i class="fas fa-chart-line"></i>
                    Tableau de bord
                </h1>
                <p class="dash-hero-sub">Vue d'ensemble de votre atelier couture</p>
            </div>
            <div class="dash-hero-actions">
                <a href="{{ route('admin.rendezvous.index') }}" class="btn-hero-primary">
                    <i class="fas fa-calendar-alt"></i> Rendez-vous
                </a>
            </div>
        </div>

        {{-- Stat Cards --}}
        <div class="stats-row">
            <div class="stat-card-new gold">
                <div class="stat-icon gold"><i class="fas fa-tshirt"></i></div>
                <div class="stat-body">
                    <div class="stat-value">{{ $stats['vetements'] }}</div>
                    <div class="stat-label">Vêtements</div>
                </div>
            </div>
            <div class="stat-card-new indigo">
                <div class="stat-icon indigo"><i class="fas fa-users"></i></div>
                <div class="stat-body">
                    <div class="stat-value">{{ $stats['clients'] }}</div>
                    <div class="stat-label">Clients</div>
                </div>
            </div>
            <div class="stat-card-new teal">
                <div class="stat-icon teal"><i class="fas fa-calendar-alt"></i></div>
                <div class="stat-body">
                    <div class="stat-value">{{ $stats['rendezVous'] }}</div>
                    <div class="stat-label">Rendez-vous</div>
                </div>
            </div>
            <div class="stat-card-new amber">
                <div class="stat-icon amber"><i class="fas fa-clock"></i></div>
                <div class="stat-body">
                    <div class="stat-value">{{ $stats['enAttente'] }}</div>
                    <div class="stat-label">En attente</div>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="row g-4">

            {{-- Vêtements --}}
            <div class="col-lg-6">
                <div class="section-card">
                    <div class="section-card-header">
                        <h5 class="section-card-title">
                            <i class="fas fa-tshirt"></i> Derniers vêtements
                        </h5>
                        <a href="{{ route('admin.vetements.index') }}" class="btn-see-all">
                            Voir tout <i class="fas fa-arrow-right fa-xs ms-1"></i>
                        </a>
                    </div>
                    <div class="section-card-body">
                        @foreach($vetements->take(5) as $vetement)
                        <div class="vet-row">
                            <div class="vet-icon"><i class="fas fa-tshirt"></i></div>
                            <div class="flex-grow-1 min-width-0">
                                <p class="vet-name">{{ $vetement->nom }}</p>
                                <p class="vet-price">{{ number_format($vetement->prix, 0, ',', ' ') }} CFA</p>
                            </div>
                            <span class="dispo-pill {{ $vetement->disponible ? 'yes' : 'no' }}">
                                <i class="fas fa-{{ $vetement->disponible ? 'check' : 'times' }}"></i>
                                {{ $vetement->disponible ? 'Disponible' : 'Indisponible' }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Rendez-vous --}}
            <div class="col-lg-6">
                <div class="section-card">
                    <div class="section-card-header">
                        <h5 class="section-card-title">
                            <i class="fas fa-calendar-alt"></i> Rendez-vous récents
                        </h5>
                        <a href="{{ route('admin.rendezvous.index') }}" class="btn-see-all">
                            Voir tout <i class="fas fa-arrow-right fa-xs ms-1"></i>
                        </a>
                    </div>
                    <div class="section-card-body">
                        @foreach($rendezVous->take(5) as $rdv)
                        @php
                            $statutKey = match($rdv->statut) {
                                \App\Models\RendezVous::STATUT_CONFIRME => 'confirme',
                                \App\Models\RendezVous::STATUT_REFUSE   => 'refuse',
                                default                                 => 'attente',
                            };
                            $initials = strtoupper(
                                substr($rdv->client->prenom ?? 'C', 0, 1) .
                                substr($rdv->client->nom    ?? '', 0, 1)
                            );
                        @endphp
                        <div class="rdv-row accent-{{ $statutKey }}">
                            <div class="rdv-row-avatar">{{ $initials }}</div>
                            <div class="rdv-row-info">
                                <p class="rdv-row-name">{{ $rdv->client->prenom }} {{ $rdv->client->nom }}</p>
                                <p class="rdv-row-date">
                                    <i class="fas fa-calendar fa-xs"></i>
                                    {{ $rdv->dateRendezVous->format('d/m/Y') }} · {{ $rdv->heure }}
                                </p>
                            </div>
                            <div class="rdv-row-actions">
                                <span class="status-dot {{ $statutKey }}">
                                    @if($statutKey === 'confirme') <i class="fas fa-check-circle"></i> Confirmé
                                    @elseif($statutKey === 'refuse') <i class="fas fa-times-circle"></i> Refusé
                                    @else <i class="fas fa-hourglass-half"></i> Attente
                                    @endif
                                </span>
                                <a href="{{ route('admin.rendezvous.show', $rdv->id) }}" class="btn-eye" title="Voir le détail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection