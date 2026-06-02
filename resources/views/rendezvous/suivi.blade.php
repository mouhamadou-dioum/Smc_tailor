@extends('layouts.master')

@section('title', 'Suivre mon Rendez-vous - Couture App')

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
@endphp

<style>
    .suivi-page { padding: 3rem 0 5rem; min-height: 80vh; background: var(--gray-100); }

    /* Search Header Banner */
    .suivi-header {
        background: linear-gradient(135deg, var(--dark) 0%, #2d2d4a 100%);
        border-radius: 20px;
        padding: 3rem 2.5rem;
        margin-bottom: 2.5rem;
        box-shadow: 0 8px 32px rgba(26,26,46,0.18);
        text-align: center;
        color: #fff;
    }
    .suivi-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        margin-bottom: 0.75rem;
        color: #fff;
    }
    .suivi-header h2 i { color: var(--primary); }
    .suivi-header p {
        color: rgba(255,255,255,0.65);
        max-width: 500px;
        margin: 0 auto;
        font-size: 0.95rem;
    }

    /* Search Box */
    .search-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
        padding: 2rem;
        max-width: 550px;
        margin: -4rem auto 3rem;
        position: relative;
        z-index: 10;
    }

    .form-control-suivi {
        border: 2px solid var(--gray-200);
        padding: 0.8rem 1.2rem;
        border-radius: 8px;
        font-size: 1rem;
        width: 100%;
        transition: all 0.3s;
        text-align: center;
        font-weight: 500;
    }
    .form-control-suivi:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(201,169,89,0.2);
        outline: none;
    }

    .btn-suivi {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s;
        font-size: 0.95rem;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
    .btn-suivi:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(201,169,89,0.3);
    }

    /* Cards layout */
    .rdv-grid {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        max-width: 800px;
        margin: 0 auto;
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
        font-size: 1.1rem;
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

    /* WhatsApp button */
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

    /* Stepper Timeline */
    .stepper-wrapper {
        display: flex;
        justify-content: space-between;
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
        position: relative;
    }
    .stepper-wrapper::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 0;
        right: 0;
        height: 4px;
        background-color: var(--gray-200);
        z-index: 1;
    }
    .stepper-item {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        z-index: 2;
    }
    .stepper-item::before {
        content: '';
        position: absolute;
        top: 20px;
        left: -50%;
        width: 100%;
        height: 4px;
        background-color: var(--gray-200);
        z-index: -1;
    }
    .stepper-item::after {
        content: '';
        position: absolute;
        top: 20px;
        right: -50%;
        width: 100%;
        height: 4px;
        background-color: var(--gray-200);
        z-index: -1;
    }
    .stepper-item:first-child::before { display: none; }
    .stepper-item:last-child::after { display: none; }

    .step-counter {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background-color: #fff;
        border: 3px solid var(--gray-200);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        color: var(--gray-500);
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .step-name {
        margin-top: 0.5rem;
        font-size: 0.72rem;
        font-weight: 700;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        text-align: center;
    }

    /* Active Step */
    .stepper-item.active .step-counter {
        border-color: var(--primary);
        color: var(--primary);
        background-color: #fff;
        box-shadow: 0 0 15px rgba(201,169,89,0.35);
        transform: scale(1.1);
        animation: pulseActive 2s infinite;
    }
    .stepper-item.active .step-name {
        color: var(--primary);
        font-weight: 800;
    }

    /* Completed Step */
    .stepper-item.completed .step-counter {
        border-color: #22c55e;
        background-color: #22c55e;
        color: #fff;
    }
    .stepper-item.completed .step-name {
        color: #166534;
    }
    .stepper-item.completed::before,
    .stepper-item.completed::after {
        background-color: #22c55e;
    }
    .stepper-item.active::before {
        background-color: #22c55e;
    }

    @keyframes pulseActive {
        0% { box-shadow: 0 0 0 0 rgba(201,169,89,0.4); }
        70% { box-shadow: 0 0 0 10px rgba(201,169,89,0); }
        100% { box-shadow: 0 0 0 0 rgba(201,169,89,0); }
    }

    @media (max-width: 768px) {
        .rdv-card {
            grid-template-columns: auto 1fr;
            grid-template-rows: auto auto auto;
            gap: 1rem;
        }
        .rdv-status { grid-column: 1; grid-row: 2; }
        .rdv-action { grid-column: 2; grid-row: 2; text-align: left; justify-content: flex-start; }
    }

    @media (max-width: 576px) {
        .step-name { font-size: 0.58rem; }
        .step-counter { width: 34px; height: 34px; font-size: 0.8rem; }
        .stepper-wrapper::before,
        .stepper-item::before,
        .stepper-item::after { top: 15px; }
        .suivi-header { padding: 2rem 1.5rem 4rem; }
    }
</style>

<div class="suivi-page">
    <div class="container">

        {{-- Header --}}
        <div class="suivi-header">
            <h2><i class="fas fa-search-location"></i> Suivi de Commande</h2>
            <p>Saisissez votre numéro de téléphone pour suivre l'avancement de votre rendez-vous et de la confection de votre tenue.</p>
        </div>

        {{-- Search Card --}}
        <div class="search-card">
            <form method="GET" action="{{ route('rendezvous.suivi') }}">
                <div class="mb-3">
                    <input
                        type="text"
                        name="telephone"
                        class="form-control-suivi @if($error) is-invalid @endif"
                        placeholder="Ex : +221 77 123 45 67"
                        required
                        value="{{ old('telephone', $telephone) }}"
                    >
                    @if($error)
                        <div class="text-danger text-center small mt-2 fw-semibold">
                            <i class="fas fa-exclamation-circle me-1"></i>{{ $error }}
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn-suivi">
                    <i class="fas fa-search me-1"></i> Rechercher
                </button>
            </form>
        </div>

        {{-- Results --}}
        @if($rendezVous->isNotEmpty())
            <div class="rdv-grid">
                @foreach($rendezVous as $rdv)
                @php
                    $vetNom = $rdv->vetement?->nom ?? null;
                    $dateObj = $rdv->dateRendezVous;
                    $waMsg = "Bonjour, j'ai réservé un rendez-vous le {$dateObj?->format('d/m/Y')} à {$rdv->heure}";
                    if ($vetNom) $waMsg .= " pour le modèle {$vetNom}";
                    $waMsg .= ". Je souhaite avoir des informations sur le suivi de ma commande.";
                    $waLink = $adminPhone ? 'https://wa.me/' . $adminPhone . '?text=' . urlencode($waMsg) : null;

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
                            {{ $vetNom ?? 'Rendez-vous général (Mesures / Conseil)' }}
                        </div>
                        @if($rdv->commentaire)
                        <div class="rdv-comment mt-1">
                            <i class="fas fa-comment-dots fa-xs me-1"></i>{{ \Illuminate\Support\Str::limit($rdv->commentaire, 80) }}
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
                        @if($waLink)
                            <a href="{{ $waLink }}" target="_blank" class="btn-wa-discuss">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                        @endif
                    </div>

                    {{-- Stepper confection (seulement si confirmé) --}}
                    @if($rdv->statut === \App\Models\RendezVous::STATUT_CONFIRME)
                    @php
                        $currentProd = $rdv->statut_production ?? 'EN_ATTENTE';
                        $steps = [
                            'MESURES'   => ['label' => 'Mesures', 'icon' => 'fas fa-ruler-combined', 'active' => false, 'completed' => false],
                            'COUPE'     => ['label' => 'Coupe', 'icon' => 'fas fa-scissors', 'active' => false, 'completed' => false],
                            'COUTURE'   => ['label' => 'Couture', 'icon' => 'fas fa-tshirt', 'active' => false, 'completed' => false],
                            'FINITIONS' => ['label' => 'Finitions', 'icon' => 'fas fa-magic', 'active' => false, 'completed' => false],
                            'PRET'      => ['label' => 'Prêt !', 'icon' => 'fas fa-gift', 'active' => false, 'completed' => false]
                        ];
                        $order = ['EN_ATTENTE', 'MESURES', 'COUPE', 'COUTURE', 'FINITIONS', 'PRET', 'LIVRE'];
                        $currentIndex = array_search($currentProd, $order);
                        if ($currentProd === 'LIVRE') {
                            $currentIndex = 5;
                        }
                        $stepKeys = array_keys($steps);
                        foreach ($stepKeys as $idx => $key) {
                            $stepIndexInOrder = $idx + 1;
                            if ($currentIndex === $stepIndexInOrder) {
                                $steps[$key]['active'] = true;
                            } elseif ($currentIndex > $stepIndexInOrder) {
                                $steps[$key]['completed'] = true;
                            }
                        }
                    @endphp
                    <div class="production-timeline-container" style="grid-column: 1 / -1; margin-top: 1rem; padding-top: 1rem; border-top: 1px dashed var(--gray-200);">
                        <div style="font-size:0.82rem; font-weight:700; color:var(--dark); margin-bottom:0.75rem; font-family:'Playfair Display', serif; display:flex; align-items:center; gap:0.4rem; flex-wrap:wrap;">
                            <i class="fas fa-spinner fa-spin" style="color:var(--primary); font-size: 0.85rem;"></i> État de confection de votre tenue : 
                            <span style="color:var(--primary); font-weight:800;">
                                @if($currentProd === 'EN_ATTENTE') En attente de prise des mesures
                                @elseif($currentProd === 'MESURES') Mensurations prises & validées
                                @elseif($currentProd === 'COUPE') Coupe du tissu en cours
                                @elseif($currentProd === 'COUTURE') Couture & Assemblage en cours
                                @elseif($currentProd === 'FINITIONS') Finitions et repassage en cours
                                @elseif($currentProd === 'PRET') Tenue prête ! Vous pouvez passer la récupérer.
                                @elseif($currentProd === 'LIVRE') Tenue livrée. Merci de votre confiance !
                                @endif
                            </span>
                        </div>
                        
                        <div class="stepper-wrapper">
                            @foreach($steps as $key => $stepData)
                                <div class="stepper-item {{ $stepData['completed'] ? 'completed' : '' }} {{ $stepData['active'] ? 'active' : '' }}">
                                    <div class="step-counter">
                                        @if($stepData['completed'])
                                            <i class="fas fa-check"></i>
                                        @else
                                            <i class="{{ $stepData['icon'] }}"></i>
                                        @endif
                                    </div>
                                    <div class="step-name">{{ $stepData['label'] }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection
