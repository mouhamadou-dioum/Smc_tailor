@extends('layouts.master')

@section('title', 'Mes rendez-vous - Couture App')

@section('content')

@php
    $admin = \App\Models\Admin::first();
    $adminPhone = '';
    if ($admin && $admin->telephone) {
        $adminPhone = preg_replace('/\D/', '', $admin->telephone);
        if (!str_starts_with($adminPhone, '221')) {
            $adminPhone = '221' . ltrim($adminPhone, '0');
        }
    }
    $client = Auth::guard('client')->user();
@endphp

<style>
    .rdv-page { padding: 2.5rem 0 4rem; min-height: 80vh; }

    /* Hero header */
    .rdv-header {
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
    .rdv-header h2 {
        color: #fff;
        font-size: 1.7rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .rdv-header h2 i { color: var(--primary); }
    .rdv-header .subtitle {
        color: rgba(255,255,255,0.55);
        font-size: 0.85rem;
        margin-top: 0.2rem;
    }

    /* Cards layout */
    .rdv-grid {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .rdv-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        border: 1.5px solid var(--gray-200);
        padding: 1.5rem 1.75rem;
        display: grid;
        grid-template-columns: auto 1fr auto auto;
        align-items: center;
        gap: 1.5rem;
        transition: box-shadow 0.2s, border-color 0.2s, transform 0.2s;
        position: relative;
        overflow: hidden;
    }
    .rdv-card:hover {
        box-shadow: 0 6px 24px rgba(201,169,89,0.12);
        border-color: var(--primary);
        transform: translateY(-2px);
    }
    .rdv-card::before {
        content: '';
        position: absolute;
        left: 0; top: 0; bottom: 0;
        width: 4px;
        border-radius: 4px 0 0 4px;
    }
    .rdv-card.statut-attente::before  { background: #f59e0b; }
    .rdv-card.statut-confirme::before { background: #22c55e; }
    .rdv-card.statut-refuse::before   { background: #ef4444; }

    /* Date block */
    .rdv-date-block {
        background: var(--gray-100);
        border-radius: 12px;
        padding: 0.75rem 1rem;
        text-align: center;
        min-width: 72px;
    }
    .rdv-date-block .day {
        font-size: 1.6rem;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        color: var(--dark);
        line-height: 1;
    }
    .rdv-date-block .month {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--primary);
        margin-top: 2px;
    }
    .rdv-date-block .time {
        font-size: 0.78rem;
        color: var(--gray-600);
        margin-top: 4px;
        font-weight: 600;
    }

    /* Info block */
    .rdv-info .rdv-vetement {
        font-size: 1rem;
        font-weight: 700;
        color: var(--dark);
        font-family: 'Playfair Display', serif;
    }
    .rdv-info .rdv-comment {
        font-size: 0.82rem;
        color: var(--gray-600);
        margin-top: 3px;
        font-style: italic;
    }

    /* Status badge */
    .rdv-status {}
    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.03em;
    }
    .status-pill.attente  { background: #fef3c7; color: #92400e; }
    .status-pill.confirme { background: #dcfce7; color: #166534; }
    .status-pill.refuse   { background: #fee2e2; color: #991b1b; }

    /* WhatsApp action */
    .rdv-action { text-align: center; min-width: 120px; }

    .btn-wa-discuss {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: #25d366;
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 0.55rem 1.2rem;
        font-size: 0.83rem;
        font-weight: 700;
        text-decoration: none;
        transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        box-shadow: 0 3px 12px rgba(37,211,102,0.3);
    }
    .btn-wa-discuss:hover {
        background: #1da851;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 5px 18px rgba(37,211,102,0.4);
    }
    .btn-wa-discuss i { font-size: 1rem; }

    .btn-wa-small {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px; height: 36px;
        background: #f0fdf4;
        color: #25d366;
        border: 1.5px solid #bbf7d0;
        border-radius: 50%;
        text-decoration: none;
        transition: all 0.2s;
        font-size: 1rem;
    }
    .btn-wa-small:hover {
        background: #25d366;
        color: #fff;
        border-color: #25d366;
    }

    .btn-wa-reprise {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: #fff;
        color: #6c757d;
        border: 1.5px solid var(--gray-300);
        border-radius: 50px;
        padding: 0.45rem 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-wa-reprise:hover {
        border-color: #25d366;
        color: #25d366;
        background: #f0fdf4;
    }

    .wa-hint {
        font-size: 0.7rem;
        color: var(--gray-600);
        margin-top: 5px;
    }

    .confirme-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        color: #166534;
        font-size: 0.82rem;
        font-weight: 700;
    }

    /* Empty state */
    .empty-state {
        background: #fff;
        border-radius: 16px;
        padding: 4rem 2rem;
        text-align: center;
        border: 2px dashed var(--gray-300);
    }
    .empty-state i {
        font-size: 3rem;
        color: var(--gray-300);
        margin-bottom: 1rem;
    }

    /* Legend */
    .rdv-legend {
        background: linear-gradient(135deg, #f0fdf4, #dcfce7);
        border: 1px solid #bbf7d0;
        border-radius: 12px;
        padding: 0.9rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-top: 1.5rem;
        font-size: 0.83rem;
        color: #166534;
    }
    .rdv-legend i { font-size: 1.1rem; color: #25d366; flex-shrink: 0; }

    @media (max-width: 768px) {
        .rdv-card {
            grid-template-columns: auto 1fr;
            grid-template-rows: auto auto;
        }
        .rdv-status { grid-column: 1; }
        .rdv-action { grid-column: 2; text-align: left; }
    }
</style>

<div class="rdv-page">
    <div class="container">

        {{-- Header --}}
        <div class="rdv-header">
            <div>
                <h2><i class="fas fa-calendar-check"></i> Mes rendez-vous</h2>
                <div class="subtitle">Suivez et gérez vos réservations en un coup d'œil</div>
            </div>
            <a href="{{ route('rendezvous.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-calendar-plus me-2"></i>Nouveau rendez-vous
            </a>
        </div>

        {{-- Liste --}}
        <div class="rdv-grid">
            @forelse($rendezVous as $rdv)
            @php
                $vetNom   = $rdv->vetement?->nom ?? null;
                $dateObj  = $rdv->dateRendezVous;
                $waMsg    = "Bonjour, je suis {$client->prenom} {$client->nom}. J'ai réservé un rendez-vous le {$dateObj?->format('d/m/Y')} à {$rdv->heure}";
                if ($vetNom) $waMsg .= " pour {$vetNom}";
                $waMsg   .= ". Je souhaite en discuter avec vous.";
                $waLink   = $adminPhone ? 'https://wa.me/' . $adminPhone . '?text=' . urlencode($waMsg) : null;

                $statutClass = match($rdv->statut) {
                    \App\Models\RendezVous::STATUT_CONFIRME => 'statut-confirme',
                    \App\Models\RendezVous::STATUT_REFUSE   => 'statut-refuse',
                    default                                 => 'statut-attente',
                };
            @endphp
            <div class="rdv-card {{ $statutClass }}">

                {{-- Date block --}}
                <div class="rdv-date-block">
                    <div class="day">{{ $dateObj?->format('d') }}</div>
                    <div class="month">{{ $dateObj?->translatedFormat('M Y') ?? $dateObj?->format('M Y') }}</div>
                    <div class="time"><i class="fas fa-clock fa-xs me-1"></i>{{ $rdv->heure }}</div>
                </div>

                {{-- Info --}}
                <div class="rdv-info">
                    <div class="rdv-vetement">
                        {{ $vetNom ?? 'Vêtement à définir' }}
                    </div>
                    @if($rdv->commentaire)
                    <div class="rdv-comment">
                        <i class="fas fa-comment-dots fa-xs me-1"></i>{{ \Illuminate\Support\Str::limit($rdv->commentaire, 70) }}
                    </div>
                    @endif
                </div>

                {{-- Statut --}}
                <div class="rdv-status">
                    @if($rdv->statut === \App\Models\RendezVous::STATUT_CONFIRME)
                        <span class="status-pill confirme">
                            <i class="fas fa-check-circle"></i> Confirmé
                        </span>
                    @elseif($rdv->statut === \App\Models\RendezVous::STATUT_REFUSE)
                        <span class="status-pill refuse">
                            <i class="fas fa-times-circle"></i> Refusé
                        </span>
                    @else
                        <span class="status-pill attente">
                            <i class="fas fa-hourglass-half"></i> En attente
                        </span>
                    @endif
                </div>

                {{-- Action WhatsApp --}}
                <div class="rdv-action">
                    @if($rdv->statut === \App\Models\RendezVous::STATUT_EN_ATTENTE)
                        @if($waLink)
                            <a href="{{ $waLink }}" target="_blank" class="btn-wa-discuss">
                                <i class="fab fa-whatsapp"></i> Discuter
                            </a>
                            <div class="wa-hint">Contacter le tailleur pour confirmer</div>
                        @endif

                    @elseif($rdv->statut === \App\Models\RendezVous::STATUT_CONFIRME)
                        <div class="confirme-label">
                            <i class="fas fa-check-circle fa-lg" style="color:#22c55e;"></i>
                            Confirmé
                            @if($waLink)
                                <a href="{{ $waLink }}" target="_blank" class="btn-wa-small" title="Contacter l'admin">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            @endif
                        </div>

                    @else
                        @if($waLink)
                            <a href="{{ $waLink }}" target="_blank" class="btn-wa-reprise">
                                <i class="fab fa-whatsapp"></i> Reprendre contact
                            </a>
                        @endif
                    @endif
                </div>

            </div>
            @empty
            <div class="empty-state">
                <i class="fas fa-calendar-xmark d-block"></i>
                <h5 style="font-family:'Playfair Display',serif; color:var(--dark);">Aucun rendez-vous</h5>
                <p class="text-muted mb-4">Vous n'avez pas encore de rendez-vous planifié.</p>
                <a href="{{ route('rendezvous.create') }}" class="btn btn-primary-custom">
                    <i class="fas fa-calendar-plus me-2"></i>Prendre un rendez-vous
                </a>
            </div>
            @endforelse
        </div>

        {{-- Légende --}}
        @if($rendezVous->isNotEmpty() && $adminPhone)
        <div class="rdv-legend">
            <i class="fab fa-whatsapp"></i>
            <span>Cliquez sur <strong>Discuter</strong> pour ouvrir WhatsApp avec un message pré-rempli. Après votre échange, l'admin confirmera votre rendez-vous.</span>
        </div>
        @endif

    </div>
</div>
@endsection