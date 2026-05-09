@extends('layouts.master')

@section('title', 'Admin - Détails du Rendez-vous')

@section('styles')
<style>
    /* ── Page layout ── */
    .detail-page {
        padding: 2.5rem 0 5rem;
        min-height: calc(100vh - 200px);
        background: var(--gray-100);
    }

    /* ── Hero Header ── */
    .detail-hero {
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

    .detail-hero::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -5%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(201,169,89,0.18) 0%, transparent 70%);
        pointer-events: none;
    }

    .detail-hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .detail-hero-title i { color: var(--primary); }

    .detail-hero-sub {
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

    /* ── Section Cards ── */
    .section-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.06);
        border: 1.5px solid var(--gray-200);
        padding: 1.5rem;
        margin-bottom: 1.25rem;
        transition: box-shadow 0.3s;
    }

    .section-card:hover {
        box-shadow: 0 6px 24px rgba(0,0,0,0.1);
    }

    .section-card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0 0 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 1.5px solid var(--gray-200);
    }

    /* ── Client Block ── */
    .client-block {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .client-avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #fff;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(201,169,89,0.35);
    }

    .client-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0 0 0.2rem;
    }

    .client-meta {
        font-size: 0.8rem;
        color: var(--gray-600);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    .btn-wa-small {
        background: #25d366;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 0.45rem 0.9rem;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: all 0.25s;
        margin-top: 0.5rem;
    }

    .btn-wa-small:hover {
        background: #1ebe5d;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37,211,102,0.35);
    }

    /* ── RDV Info Block ── */
    .rdv-info-grid {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 1rem;
        align-items: start;
    }

    .date-badge {
        background: linear-gradient(135deg, var(--dark), #2d2d4e);
        color: #fff;
        border-radius: 14px;
        padding: 0.75rem 1rem;
        text-align: center;
        min-width: 68px;
        box-shadow: 0 4px 12px rgba(26,26,46,0.2);
    }

    .date-badge .day {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary);
        line-height: 1;
    }

    .date-badge .month {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(255,255,255,0.7);
        margin-top: 0.15rem;
    }

    .date-badge .time {
        font-size: 0.75rem;
        color: rgba(255,255,255,0.55);
        margin-top: 0.4rem;
        padding-top: 0.4rem;
        border-top: 1px solid rgba(255,255,255,0.15);
    }

    .rdv-vet-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0 0 0.35rem;
    }

    .rdv-comment-text {
        font-size: 0.85rem;
        color: var(--gray-600);
        margin: 0 0 0.6rem;
        font-style: italic;
    }

    /* ── Status Pills ── */
    .status-pill-lg {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.4rem 0.9rem;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .status-pill-lg.confirme {
        background: #d4edda;
        color: #155724;
    }

    .status-pill-lg.attente {
        background: #fff3cd;
        color: #856404;
    }

    .status-pill-lg.refuse {
        background: #f8d7da;
        color: #721c24;
    }

    /* ── Left border accent ── */
    .border-confirme { border-left: 4px solid #28a745; }
    .border-attente  { border-left: 4px solid #ffc107; }
    .border-refuse   { border-left: 4px solid #dc3545; }

    /* ── WhatsApp History ── */
    .wa-log-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.75rem;
        border-radius: 12px;
        background: var(--gray-100);
        border: 1px solid var(--gray-200);
        margin-bottom: 0.6rem;
        transition: background 0.2s;
    }

    .wa-log-item:last-child { margin-bottom: 0; }

    .wa-log-item:hover { background: #f0f0f0; }

    .wa-icon {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
    }

    .wa-icon.sent   { background: #d4edda; color: #25d366; }
    .wa-icon.failed { background: #f8d7da; color: #dc3545; }

    .wa-log-content {
        flex: 1;
        min-width: 0;
    }

    .wa-log-status {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.15rem;
    }

    .wa-log-status.sent   { color: #25d366; }
    .wa-log-status.failed { color: #dc3545; }

    .wa-log-text {
        font-size: 0.82rem;
        color: var(--gray-700);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .wa-log-time {
        font-size: 0.72rem;
        color: var(--gray-500);
        text-align: right;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .empty-wa {
        text-align: center;
        padding: 1.5rem 0 0.5rem;
        color: var(--gray-500);
        font-size: 0.875rem;
    }

    .empty-wa i { font-size: 2rem; opacity: 0.3; display: block; margin-bottom: 0.5rem; }

    /* ── Step Cards (Actions) ── */
    .step-card {
        background: #fff;
        border-radius: 18px;
        border: 1.5px solid var(--gray-200);
        padding: 1.5rem;
        margin-bottom: 1.25rem;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        transition: box-shadow 0.3s;
    }

    .step-card:hover { box-shadow: 0 6px 24px rgba(0,0,0,0.09); }

    .step-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
    }

    .step-badge {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--dark);
        color: var(--primary);
        font-size: 0.8rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .step-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0;
    }

    .step-desc {
        font-size: 0.82rem;
        color: var(--gray-600);
        margin: 0 0 1rem;
        padding-left: 2.75rem;
    }

    /* ── Action Buttons ── */
    .btn-confirm {
        background: linear-gradient(135deg, #28a745, #20c43a);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 0.65rem 1.25rem;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.25s;
        box-shadow: 0 4px 12px rgba(40,167,69,0.3);
    }

    .btn-confirm:hover {
        background: linear-gradient(135deg, #218838, #1db935);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(40,167,69,0.4);
    }

    .btn-refuse {
        background: linear-gradient(135deg, #dc3545, #e04555);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 0.65rem 1.25rem;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.25s;
        box-shadow: 0 4px 12px rgba(220,53,69,0.3);
    }

    .btn-refuse:hover {
        background: linear-gradient(135deg, #c82333, #d43545);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(220,53,69,0.4);
    }

    .btn-wa-full {
        background: linear-gradient(135deg, #25d366, #1ebe5d);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 0.65rem 1.25rem;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        transition: all 0.25s;
        box-shadow: 0 4px 12px rgba(37,211,102,0.3);
    }

    .btn-wa-full:hover {
        background: linear-gradient(135deg, #1ebe5d, #18a852);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(37,211,102,0.4);
    }

    .btn-primary-custom-lg {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 0.65rem 1.25rem;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.25s;
        box-shadow: 0 4px 12px rgba(201,169,89,0.3);
    }

    .btn-primary-custom-lg:hover {
        background: linear-gradient(135deg, var(--primary-dark), #9a7d3a);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(201,169,89,0.4);
    }

    .btn-outline-custom-lg {
        border: 2px solid var(--primary);
        color: var(--primary);
        background: transparent;
        border-radius: 12px;
        padding: 0.6rem 1.2rem;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.25s;
    }

    .btn-outline-custom-lg:hover {
        background: var(--primary);
        color: #fff;
        transform: translateY(-2px);
    }

    /* ── Status final banners ── */
    .banner-confirmed {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        border: 1.5px solid #b8dac4;
        border-radius: 14px;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        color: #155724;
        font-weight: 600;
        margin-bottom: 1.25rem;
    }

    .banner-refused {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        border: 1.5px solid #f0b8bd;
        border-radius: 14px;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        color: #721c24;
        font-weight: 600;
    }

    /* ── Phone missing ── */
    .no-phone {
        background: #fff3cd;
        border: 1px solid #ffc107;
        border-radius: 10px;
        padding: 0.6rem 0.85rem;
        font-size: 0.82rem;
        color: #856404;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    /* ── Responsive ── */
    @media (max-width: 768px) {
        .detail-hero { padding: 1.5rem; border-radius: 16px; }
        .detail-hero-title { font-size: 1.4rem; }
        .rdv-info-grid { grid-template-columns: 1fr; }
        .date-badge { display: none; }
    }
</style>
@endsection

@section('content')
@php
    $rawPhone = $rendezVous->client->telephone ?? '';
    $phone = preg_replace('/\D/', '', $rawPhone);
    if ($phone && !str_starts_with($phone, '221')) {
        $phone = '221' . ltrim($phone, '0');
    }
    $vetNom = $rendezVous->vetement?->nom ?? 'votre commande';
    $waDiscuss = urlencode(
        "Bonjour {$rendezVous->client->prenom}, je vous contacte concernant votre rendez-vous du {$rendezVous->dateRendezVous->format('d/m/Y')} à {$rendezVous->heure} pour {$vetNom}."
    );

    $waNotifs = $rendezVous->notifications
        ->where('type', 'WHATSAPP')
        ->sortByDesc('dateEnvoi');
    $lastWa = $waNotifs->first();

    $statutClass = match($rendezVous->statut) {
        \App\Models\RendezVous::STATUT_CONFIRME => 'confirme',
        \App\Models\RendezVous::STATUT_REFUSE   => 'refuse',
        default                                 => 'attente',
    };

    $borderClass = match($rendezVous->statut) {
        \App\Models\RendezVous::STATUT_CONFIRME => 'border-confirme',
        \App\Models\RendezVous::STATUT_REFUSE   => 'border-refuse',
        default                                 => 'border-attente',
    };

    // Initials for avatar
    $initials = strtoupper(
        substr($rendezVous->client->prenom ?? 'C', 0, 1) .
        substr($rendezVous->client->nom    ?? '', 0, 1)
    );
@endphp

<div class="detail-page">
    <div class="container">

        {{-- Hero Header --}}
        <div class="detail-hero">
            <div>
                <h1 class="detail-hero-title">
                    <i class="fas fa-calendar-check"></i>
                    Détails du Rendez-vous
                </h1>
                <p class="detail-hero-sub">Informations complètes et actions disponibles</p>
            </div>
            <a href="{{ route('admin.rendezvous.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Retour à la liste
            </a>
        </div>

        {{-- Success Alert --}}
        @if(session('success'))
            <div class="alert-success-custom">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="row g-4">

            {{-- ═══════════════ COLONNE GAUCHE ═══════════════ --}}
            <div class="col-lg-6">

                {{-- Client Card --}}
                <div class="section-card">
                    <h6 class="section-card-title">
                        <i class="fas fa-user" style="color:var(--primary);"></i>
                        Informations client
                    </h6>
                    <div class="client-block">
                        <div class="client-avatar">{{ $initials }}</div>
                        <div class="flex-grow-1">
                            <p class="client-name">{{ $rendezVous->client->prenom }} {{ $rendezVous->client->nom }}</p>
                            <p class="client-meta">
                                <i class="fas fa-envelope fa-xs"></i>
                                {{ $rendezVous->client->email }}
                            </p>
                            <p class="client-meta mt-1">
                                <i class="fas fa-phone fa-xs"></i>
                                {{ $rendezVous->client->telephone ?? 'Non renseigné' }}
                            </p>
                            @if($phone)
                                <a href="https://wa.me/{{ $phone }}" target="_blank" class="btn-wa-small">
                                    <i class="fab fa-whatsapp"></i> Ouvrir WhatsApp
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- RDV Details Card --}}
                <div class="section-card {{ $borderClass }}">
                    <h6 class="section-card-title">
                        <i class="fas fa-calendar-alt" style="color:var(--primary);"></i>
                        Détails du rendez-vous
                    </h6>
                    <div class="rdv-info-grid">
                        <div class="date-badge">
                            <div class="day">{{ $rendezVous->dateRendezVous->format('d') }}</div>
                            <div class="month">{{ $rendezVous->dateRendezVous->translatedFormat('M Y') }}</div>
                            <div class="time"><i class="fas fa-clock fa-xs me-1"></i>{{ $rendezVous->heure }}</div>
                        </div>
                        <div>
                            <p class="rdv-vet-name">
                                <i class="fas fa-tshirt fa-sm me-1" style="color:var(--primary);opacity:0.7;"></i>
                                {{ $rendezVous->vetement->nom ?? 'À définir' }}
                            </p>
                            @if($rendezVous->commentaire)
                                <p class="rdv-comment-text">
                                    <i class="fas fa-comment-dots fa-xs me-1"></i>
                                    {{ Str::limit($rendezVous->commentaire, 80) }}
                                </p>
                            @endif
                            <span class="status-pill-lg {{ $statutClass }}">
                                @if($rendezVous->statut === \App\Models\RendezVous::STATUT_CONFIRME)
                                    <i class="fas fa-check-circle"></i> Confirmé
                                @elseif($rendezVous->statut === \App\Models\RendezVous::STATUT_REFUSE)
                                    <i class="fas fa-times-circle"></i> Refusé
                                @else
                                    <i class="fas fa-hourglass-half"></i> En attente
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                {{-- WhatsApp History --}}
                <div class="section-card">
                    <h6 class="section-card-title">
                        <i class="fab fa-whatsapp" style="color:#25d366;"></i>
                        Historique WhatsApp
                    </h6>

                    @if($waNotifs->isEmpty())
                        <div class="empty-wa">
                            <i class="fab fa-whatsapp"></i>
                            Aucun message WhatsApp envoyé pour ce rendez-vous.
                        </div>
                    @else
                        @foreach($waNotifs as $notif)
                        <div class="wa-log-item">
                            <div class="wa-icon {{ $notif->statut === 'ENVOYE' ? 'sent' : 'failed' }}">
                                <i class="{{ $notif->statut === 'ENVOYE' ? 'fab fa-whatsapp' : 'fas fa-exclamation-triangle' }}"></i>
                            </div>
                            <div class="wa-log-content">
                                <div class="wa-log-status {{ $notif->statut === 'ENVOYE' ? 'sent' : 'failed' }}">
                                    {{ $notif->statut === 'ENVOYE' ? 'Envoyé' : 'Échec d\'envoi' }}
                                </div>
                                <div class="wa-log-text">{{ Str::limit($notif->contenu, 65) }}</div>
                            </div>
                            <div class="wa-log-time">
                                {{ $notif->dateEnvoi->format('d/m H:i') }}<br>
                                <span style="opacity:0.7;">{{ $notif->dateEnvoi->diffForHumans() }}</span>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>

            </div>

            {{-- ═══════════════ COLONNE DROITE : ACTIONS ═══════════════ --}}
            <div class="col-lg-6">

                @if($rendezVous->statut === \App\Models\RendezVous::STATUT_EN_ATTENTE)

                    {{-- Étape 1 : Discuter --}}
                    <div class="step-card">
                        <div class="step-header">
                            <div class="step-badge">1</div>
                            <p class="step-title">Discuter avec le client</p>
                        </div>
                        <p class="step-desc">Contactez le client sur WhatsApp pour confirmer les détails avant de valider.</p>

                        @if($phone)
                            <a href="https://wa.me/{{ $phone }}?text={{ $waDiscuss }}"
                               target="_blank" class="btn-wa-full">
                                <i class="fab fa-whatsapp"></i> Ouvrir la conversation WhatsApp
                            </a>
                        @else
                            <div class="no-phone">
                                <i class="fas fa-exclamation-circle"></i>
                                Numéro de téléphone non renseigné — action impossible.
                            </div>
                        @endif
                    </div>

                    {{-- Étape 2 : Valider ou refuser --}}
                    <div class="step-card">
                        <div class="step-header">
                            <div class="step-badge">2</div>
                            <p class="step-title">Valider ou refuser</p>
                        </div>
                        <p class="step-desc">Un message WhatsApp sera automatiquement envoyé au client après votre décision.</p>

                        <div class="d-flex gap-3">
                            <a href="{{ route('admin.rendezvous.confirmer', $rendezVous->id) }}"
                               class="btn-confirm flex-grow-1"
                               onclick="return confirm('Confirmer ce rendez-vous ?')">
                                <i class="fas fa-check-circle"></i> Confirmer
                            </a>
                            <a href="{{ route('admin.rendezvous.refuser', $rendezVous->id) }}"
                               class="btn-refuse flex-grow-1"
                               onclick="return confirm('Refuser ce rendez-vous ?')">
                                <i class="fas fa-times-circle"></i> Refuser
                            </a>
                        </div>
                    </div>

                @elseif($rendezVous->statut === \App\Models\RendezVous::STATUT_CONFIRME)

                    <div class="step-card">
                        <div class="banner-confirmed">
                            <i class="fas fa-check-circle fa-lg"></i>
                            Ce rendez-vous a été confirmé. Le client a été notifié par WhatsApp.
                        </div>
                        <p class="step-desc" style="padding-left:0; margin-bottom:1rem;">
                            Vous pouvez maintenant prendre ou consulter les mesures du client.
                        </p>
                        <div class="d-flex gap-3">
                            <a href="{{ route('admin.mesures.create', $rendezVous->client_id) }}"
                               class="btn-primary-custom-lg flex-grow-1">
                                <i class="fas fa-ruler"></i> Prendre les mesures
                            </a>
                            <a href="{{ route('admin.mesures.historique', $rendezVous->client_id) }}"
                               class="btn-outline-custom-lg flex-grow-1">
                                <i class="fas fa-history"></i> Historique
                            </a>
                        </div>
                    </div>

                @else

                    <div class="step-card">
                        <div class="banner-refused">
                            <i class="fas fa-times-circle fa-lg"></i>
                            Ce rendez-vous a été refusé. Le client a été notifié par WhatsApp.
                        </div>
                    </div>

                @endif

            </div>
        </div>

    </div>
</div>
@endsection