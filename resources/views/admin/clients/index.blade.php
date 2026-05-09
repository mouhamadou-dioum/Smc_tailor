@extends('layouts.master')

@section('title', 'Admin - Clients')

@section('styles')
<style>
    /* ── Page ── */
    .clients-page {
        padding: 2.5rem 0 5rem;
        min-height: calc(100vh - 200px);
        background: var(--gray-100);
    }

    /* ── Hero Header ── */
    .clients-hero {
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

    .clients-hero::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -5%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(201,169,89,0.18) 0%, transparent 70%);
        pointer-events: none;
    }

    .clients-hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .clients-hero-title i { color: var(--primary); }

    .clients-hero-sub {
        color: rgba(255,255,255,0.5);
        font-size: 0.875rem;
        margin: 0;
    }

    .btn-back {
        border: 1.5px solid rgba(255,255,255,0.3);
        color: #fff;
        background: rgba(255,255,255,0.07);
        padding: 0.55rem 1.25rem;
        border-radius: 10px;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.25s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        white-space: nowrap;
    }

    .btn-back:hover {
        background: rgba(255,255,255,0.15);
        color: #fff;
        transform: translateX(-3px);
    }

    /* ── Alert ── */
    .alert-success-custom {
        background: #d4edda;
        border: 1px solid #b8dac4;
        color: #155724;
        border-radius: 12px;
        padding: 0.85rem 1.1rem;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    /* ── Stats Bar ── */
    .stats-bar {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.75rem;
        flex-wrap: wrap;
    }

    .stat-chip {
        background: #fff;
        border: 1.5px solid var(--gray-200);
        border-radius: 14px;
        padding: 0.75rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        flex: 1;
        min-width: 140px;
    }

    .stat-chip-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .stat-chip-icon.gold   { background: rgba(201,169,89,0.15); color: var(--primary); }
    .stat-chip-icon.blue   { background: rgba(99,102,241,0.12); color: #6366f1; }
    .stat-chip-icon.green  { background: rgba(40,167,69,0.12);  color: #28a745; }

    .stat-chip-value {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--dark);
        line-height: 1;
    }

    .stat-chip-label {
        font-size: 0.72rem;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 0.1rem;
    }

    /* ── Clients Grid ── */
    .clients-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.25rem;
    }

    /* ── Client Card ── */
    .client-card {
        background: #fff;
        border-radius: 18px;
        border: 1.5px solid var(--gray-200);
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .client-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 28px rgba(0,0,0,0.1);
        border-color: var(--primary);
    }

    .client-card-body {
        padding: 1.25rem;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        flex: 1;
    }

    .client-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(201,169,89,0.3);
    }

    .client-info {
        flex: 1;
        min-width: 0;
    }

    .client-name {
        font-family: 'Playfair Display', serif;
        font-size: 1rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0 0 0.3rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .client-meta {
        font-size: 0.78rem;
        color: var(--gray-600);
        margin: 0 0 0.2rem;
        display: flex;
        align-items: center;
        gap: 0.35rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .client-meta i { color: var(--gray-400); flex-shrink: 0; }

    /* ── Card Footer ── */
    .client-card-footer {
        border-top: 1.5px solid var(--gray-200);
        padding: 0.75rem 1.25rem;
        background: var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .rdv-count-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: rgba(201,169,89,0.12);
        border: 1px solid rgba(201,169,89,0.3);
        color: var(--primary-dark);
        border-radius: 999px;
        padding: 0.3rem 0.75rem;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .inscription-date {
        font-size: 0.72rem;
        color: var(--gray-500);
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    /* ── Action Buttons ── */
    .client-actions {
        display: flex;
        gap: 0.5rem;
        flex-direction: column;
        align-items: flex-end;
        flex-shrink: 0;
    }

    .btn-action-sm {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.25s;
    }

    .btn-action-sm.mesures {
        background: rgba(201,169,89,0.12);
        color: var(--primary-dark);
        border: 1px solid rgba(201,169,89,0.3);
    }

    .btn-action-sm.mesures:hover {
        background: var(--primary);
        color: #fff;
        transform: scale(1.1);
    }

    .btn-action-sm.histo {
        background: rgba(99,102,241,0.1);
        color: #6366f1;
        border: 1px solid rgba(99,102,241,0.2);
    }

    .btn-action-sm.histo:hover {
        background: #6366f1;
        color: #fff;
        transform: scale(1.1);
    }

    /* ── Empty State ── */
    .empty-clients {
        grid-column: 1 / -1;
        background: #fff;
        border-radius: 18px;
        border: 1.5px dashed var(--gray-300);
        padding: 4rem 2rem;
        text-align: center;
        color: var(--gray-500);
    }

    .empty-clients i {
        font-size: 3rem;
        opacity: 0.2;
        display: block;
        margin-bottom: 1rem;
        color: var(--dark);
    }

    .empty-clients h5 {
        font-family: 'Playfair Display', serif;
        color: var(--dark);
        margin-bottom: 0.4rem;
    }

    @media (max-width: 576px) {
        .clients-hero { padding: 1.25rem; border-radius: 16px; }
        .clients-hero-title { font-size: 1.35rem; }
        .clients-grid { grid-template-columns: 1fr; }
        .stat-chip { min-width: unset; }
    }
</style>
@endsection

@section('content')
@php
    $totalRdv = $clients->sum(fn($c) => $c->rendezVous->count());
    $totalMesures = $clients->sum(fn($c) => $c->mesures->count() ?? 0);
@endphp

<div class="clients-page">
    <div class="container">

        {{-- Hero Header --}}
        <div class="clients-hero">
            <div>
                <h1 class="clients-hero-title">
                    <i class="fas fa-users"></i>
                    Clients inscrits
                </h1>
                <p class="clients-hero-sub">Gérez vos clients et suivez leurs activités</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Tableau de bord
            </a>
        </div>

        {{-- Alert --}}
        @if(session('success'))
            <div class="alert-success-custom">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- Stats Bar --}}
        @if($clients->isNotEmpty())
        <div class="stats-bar">
            <div class="stat-chip">
                <div class="stat-chip-icon gold"><i class="fas fa-users"></i></div>
                <div>
                    <div class="stat-chip-value">{{ $clients->count() }}</div>
                    <div class="stat-chip-label">Clients</div>
                </div>
            </div>
            <div class="stat-chip">
                <div class="stat-chip-icon blue"><i class="fas fa-calendar-check"></i></div>
                <div>
                    <div class="stat-chip-value">{{ $totalRdv }}</div>
                    <div class="stat-chip-label">Rendez-vous</div>
                </div>
            </div>
            <div class="stat-chip">
                <div class="stat-chip-icon green"><i class="fas fa-ruler-combined"></i></div>
                <div>
                    <div class="stat-chip-value">{{ $totalMesures }}</div>
                    <div class="stat-chip-label">Mesures</div>
                </div>
            </div>
        </div>
        @endif

        {{-- Clients Grid --}}
        <div class="clients-grid">
            @forelse($clients as $client)
            @php
                $initials = strtoupper(
                    substr($client->prenom ?? 'C', 0, 1) .
                    substr($client->nom    ?? '', 0, 1)
                );
            @endphp

            <div class="client-card">
                <div class="client-card-body">
                    <div class="client-avatar">{{ $initials }}</div>
                    <div class="client-info">
                        <p class="client-name">{{ $client->prenom }} {{ $client->nom }}</p>
                        <p class="client-meta">
                            <i class="fas fa-envelope fa-xs"></i>
                            {{ $client->email }}
                        </p>
                        <p class="client-meta">
                            <i class="fas fa-phone fa-xs"></i>
                            {{ $client->telephone ?? 'Non renseigné' }}
                        </p>
                    </div>
                    <div class="client-actions">
                        <a href="{{ route('admin.mesures.create', $client->id) }}"
                           class="btn-action-sm mesures" title="Prendre les mesures">
                            <i class="fas fa-ruler"></i>
                        </a>
                        <a href="{{ route('admin.mesures.historique', $client->id) }}"
                           class="btn-action-sm histo" title="Historique des mesures">
                            <i class="fas fa-history"></i>
                        </a>
                    </div>
                </div>

                <div class="client-card-footer">
                    <span class="rdv-count-pill">
                        <i class="fas fa-calendar-check fa-xs"></i>
                        {{ $client->rendezVous->count() }} rendez-vous
                    </span>
                    <span class="inscription-date">
                        <i class="fas fa-clock fa-xs"></i>
                        {{ $client->dateInscription?->format('d/m/Y') ?? '—' }}
                    </span>
                </div>
            </div>

            @empty
            <div class="empty-clients">
                <i class="fas fa-users"></i>
                <h5>Aucun client enregistré</h5>
                <p class="mb-0">Les clients apparaîtront ici dès leur inscription.</p>
            </div>
            @endforelse
        </div>

    </div>
</div>
@endsection