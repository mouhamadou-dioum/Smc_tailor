<?php $__env->startSection('title', 'Admin - Détails du Rendez-vous'); ?>

<?php $__env->startSection('styles'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
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
?>

<div class="detail-page">
    <div class="container">

        
        <div class="detail-hero">
            <div>
                <h1 class="detail-hero-title">
                    <i class="fas fa-calendar-check"></i>
                    Détails du Rendez-vous
                </h1>
                <p class="detail-hero-sub">Informations complètes et actions disponibles</p>
            </div>
            <a href="<?php echo e(route('admin.rendezvous.index')); ?>" class="btn-back">
                <i class="fas fa-arrow-left"></i> Retour à la liste
            </a>
        </div>

        
        <?php if(session('success')): ?>
            <div class="alert-success-custom d-flex justify-content-between align-items-center flex-wrap gap-2">
                <span>
                    <i class="fas fa-check-circle"></i>
                    <?php echo e(session('success')); ?>

                </span>
                <?php if(session('wa_link')): ?>
                    <a href="<?php echo e(session('wa_link')); ?>" target="_blank" class="btn btn-success btn-sm d-inline-flex align-items-center gap-2" style="background-color: #25d366; border-color: #25d366; color: white; padding: 0.4rem 1rem; border-radius: 50px; font-weight: 600; text-decoration: none; font-size: 0.8rem;">
                        <i class="fab fa-whatsapp"></i> Envoyer la confirmation via WhatsApp
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="row g-4">

            
            <div class="col-lg-6">

                
                <div class="section-card">
                    <h6 class="section-card-title">
                        <i class="fas fa-user" style="color:var(--primary);"></i>
                        Informations client
                    </h6>
                    <div class="client-block">
                        <div class="client-avatar"><?php echo e($initials); ?></div>
                        <div class="flex-grow-1">
                            <p class="client-name"><?php echo e($rendezVous->client->prenom); ?> <?php echo e($rendezVous->client->nom); ?></p>
                            <p class="client-meta">
                                <i class="fas fa-envelope fa-xs"></i>
                                <?php echo e($rendezVous->client->email); ?>

                            </p>
                            <p class="client-meta mt-1">
                                <i class="fas fa-phone fa-xs"></i>
                                <?php echo e($rendezVous->client->telephone ?? 'Non renseigné'); ?>

                            </p>
                            <?php if($phone): ?>
                                <a href="https://wa.me/<?php echo e($phone); ?>" target="_blank" class="btn-wa-small">
                                    <i class="fab fa-whatsapp"></i> Ouvrir WhatsApp
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                
                <div class="section-card <?php echo e($borderClass); ?>">
                    <h6 class="section-card-title">
                        <i class="fas fa-calendar-alt" style="color:var(--primary);"></i>
                        Détails du rendez-vous
                    </h6>
                    <div class="rdv-info-grid">
                        <div class="date-badge">
                            <div class="day"><?php echo e($rendezVous->dateRendezVous->format('d')); ?></div>
                            <div class="month"><?php echo e($rendezVous->dateRendezVous->translatedFormat('M Y')); ?></div>
                            <div class="time"><i class="fas fa-clock fa-xs me-1"></i><?php echo e($rendezVous->heure); ?></div>
                        </div>
                        <div>
                            <p class="rdv-vet-name">
                                <i class="fas fa-tshirt fa-sm me-1" style="color:var(--primary);opacity:0.7;"></i>
                                <?php echo e($rendezVous->vetement->nom ?? 'À définir'); ?>

                            </p>
                            <?php if($rendezVous->commentaire): ?>
                                <p class="rdv-comment-text">
                                    <i class="fas fa-comment-dots fa-xs me-1"></i>
                                    <?php echo e(Str::limit($rendezVous->commentaire, 80)); ?>

                                </p>
                            <?php endif; ?>
                            <span class="status-pill-lg <?php echo e($statutClass); ?>">
                                <?php if($rendezVous->statut === \App\Models\RendezVous::STATUT_CONFIRME): ?>
                                    <i class="fas fa-check-circle"></i> Confirmé
                                <?php elseif($rendezVous->statut === \App\Models\RendezVous::STATUT_REFUSE): ?>
                                    <i class="fas fa-times-circle"></i> Refusé
                                <?php else: ?>
                                    <i class="fas fa-hourglass-half"></i> En attente
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                </div>

                
                <div class="section-card">
                    <h6 class="section-card-title">
                        <i class="fab fa-whatsapp" style="color:#25d366;"></i>
                        Historique WhatsApp
                    </h6>

                    <?php if($waNotifs->isEmpty()): ?>
                        <div class="empty-wa">
                            <i class="fab fa-whatsapp"></i>
                            Aucun message WhatsApp envoyé pour ce rendez-vous.
                        </div>
                    <?php else: ?>
                        <?php $__currentLoopData = $waNotifs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $statusClass = match($notif->statut) {
                                'ENVOYE' => 'sent',
                                'A_ENVOYER' => 'pending',
                                default => 'failed',
                            };
                            $statusLabel = match($notif->statut) {
                                'ENVOYE' => 'Envoyé',
                                'A_ENVOYER' => 'À envoyer (manuel)',
                                default => 'Échec d\'envoi',
                            };
                            $statusIcon = match($notif->statut) {
                                'ENVOYE', 'A_ENVOYER' => 'fab fa-whatsapp',
                                default => 'fas fa-exclamation-triangle',
                            };
                            $pendingStyle = $notif->statut === 'A_ENVOYER' ? 'background: #fef3c7; color: #92400e;' : '';
                            $pendingTextStyle = $notif->statut === 'A_ENVOYER' ? 'color: #92400e;' : '';
                        ?>
                        <div class="wa-log-item">
                            <div class="wa-icon <?php echo e($statusClass); ?>" style="<?php echo e($pendingStyle); ?>">
                                <i class="<?php echo e($statusIcon); ?>"></i>
                            </div>
                            <div class="wa-log-content">
                                <div class="wa-log-status <?php echo e($statusClass); ?>" style="<?php echo e($pendingTextStyle); ?>">
                                    <?php echo e($statusLabel); ?>

                                </div>
                                <div class="wa-log-text"><?php echo e(Str::limit($notif->contenu, 65)); ?></div>
                                <?php if($notif->statut === 'A_ENVOYER'): ?>
                                    <?php
                                        $waDirectLink = $phone ? 'https://wa.me/'.$phone.'?text='.rawurlencode($notif->contenu) : null;
                                    ?>
                                    <?php if($waDirectLink): ?>
                                        <div class="mt-1">
                                            <a href="<?php echo e($waDirectLink); ?>" target="_blank" class="btn btn-sm btn-success py-0 px-2" style="background-color: #25d366; border-color: #25d366; font-size: 0.72rem; color: white; border-radius: 4px; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                                <i class="fab fa-whatsapp"></i> Envoyer maintenant
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="wa-log-time">
                                <?php echo e($notif->dateEnvoi->format('d/m H:i')); ?><br>
                                <span style="opacity:0.7;"><?php echo e($notif->dateEnvoi->diffForHumans()); ?></span>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>

            </div>

            
            <div class="col-lg-6">

                <?php if($rendezVous->statut === \App\Models\RendezVous::STATUT_EN_ATTENTE): ?>

                    
                    <div class="step-card">
                        <div class="step-header">
                            <div class="step-badge">1</div>
                            <p class="step-title">Discuter avec le client</p>
                        </div>
                        <p class="step-desc">Contactez le client sur WhatsApp pour confirmer les détails avant de valider.</p>

                        <?php if($phone): ?>
                            <a href="https://wa.me/<?php echo e($phone); ?>?text=<?php echo e($waDiscuss); ?>"
                               target="_blank" class="btn-wa-full">
                                <i class="fab fa-whatsapp"></i> Ouvrir la conversation WhatsApp
                            </a>
                        <?php else: ?>
                            <div class="no-phone">
                                <i class="fas fa-exclamation-circle"></i>
                                Numéro de téléphone non renseigné — action impossible.
                            </div>
                        <?php endif; ?>
                    </div>

                    
                    <div class="step-card">
                        <div class="step-header">
                            <div class="step-badge">2</div>
                            <p class="step-title">Valider ou refuser</p>
                        </div>
                        <p class="step-desc">Vous pourrez envoyer le message de confirmation/refus par WhatsApp après votre décision.</p>

                        <div class="d-flex gap-3">
                            <a href="<?php echo e(route('admin.rendezvous.confirmer', $rendezVous->id)); ?>"
                               class="btn-confirm flex-grow-1"
                               onclick="return confirm('Confirmer ce rendez-vous ?')">
                                <i class="fas fa-check-circle"></i> Confirmer
                            </a>
                            <a href="<?php echo e(route('admin.rendezvous.refuser', $rendezVous->id)); ?>"
                               class="btn-refuse flex-grow-1"
                               onclick="return confirm('Refuser ce rendez-vous ?')">
                                <i class="fas fa-times-circle"></i> Refuser
                            </a>
                        </div>
                    </div>

                <?php elseif($rendezVous->statut === \App\Models\RendezVous::STATUT_CONFIRME): ?>

                    <div class="step-card">
                        <div class="banner-confirmed" style="<?php echo e($lastWa && $lastWa->statut === 'A_ENVOYER' ? 'background: linear-gradient(135deg, #fef3c7, #fde68a); border-color: #f59e0b; color: #92400e;' : ''); ?>">
                            <?php if($lastWa && $lastWa->statut === 'A_ENVOYER'): ?>
                                <i class="fas fa-exclamation-circle fa-lg"></i>
                                Ce rendez-vous a été confirmé. N'oubliez pas d'envoyer le message de confirmation par WhatsApp.
                            <?php else: ?>
                                <i class="fas fa-check-circle fa-lg"></i>
                                Ce rendez-vous a été confirmé. Le client a été notifié par WhatsApp.
                            <?php endif; ?>
                        </div>
                        <p class="step-desc" style="padding-left:0; margin-bottom:1rem;">
                            Vous pouvez maintenant prendre ou consulter les mesures du client.
                        </p>
                        <div class="d-flex gap-3">
                            <a href="<?php echo e(route('admin.mesures.create', $rendezVous->client_id)); ?>"
                               class="btn-primary-custom-lg flex-grow-1">
                                <i class="fas fa-ruler"></i> Prendre les mesures
                            </a>
                            <a href="<?php echo e(route('admin.mesures.historique', $rendezVous->client_id)); ?>"
                               class="btn-outline-custom-lg flex-grow-1">
                                <i class="fas fa-history"></i> Historique
                            </a>
                        </div>
                    </div>

                    
                    <div class="step-card">
                        <div class="step-header">
                            <div class="step-badge" style="background:var(--primary); color:#fff;"><i class="fas fa-scissors"></i></div>
                            <p class="step-title">Suivi de production (Timeline)</p>
                        </div>
                        <p class="step-desc">Mettez à jour l'étape de confection de la tenue pour le client.</p>

                        <form action="<?php echo e(route('admin.rendezvous.production', $rendezVous->id)); ?>" method="POST" class="mt-2">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label class="form-label-custom" style="font-size:0.85rem; font-weight:600;">Étape de confection actuelle :</label>
                                <select name="statut_production" class="form-select form-control-custom" style="border: 1.5px solid var(--gray-300); border-radius:10px; padding:0.6rem 0.85rem; font-size:0.875rem; background-color:#fff;">
                                    <option value="EN_ATTENTE" <?php echo e($rendezVous->statut_production === 'EN_ATTENTE' ? 'selected' : ''); ?>>1. En attente du rendez-vous / des mesures</option>
                                    <option value="MESURES" <?php echo e($rendezVous->statut_production === 'MESURES' ? 'selected' : ''); ?>>2. Mesures enregistrées</option>
                                    <option value="COUPE" <?php echo e($rendezVous->statut_production === 'COUPE' ? 'selected' : ''); ?>>3. Coupe du tissu</option>
                                    <option value="COUTURE" <?php echo e($rendezVous->statut_production === 'COUTURE' ? 'selected' : ''); ?>>4. Couture / Assemblage</option>
                                    <option value="FINITIONS" <?php echo e($rendezVous->statut_production === 'FINITIONS' ? 'selected' : ''); ?>>5. Finitions & Repassage</option>
                                    <option value="PRET" <?php echo e($rendezVous->statut_production === 'PRET' ? 'selected' : ''); ?>>6. Prêt pour retrait (Prêt !)</option>
                                    <option value="LIVRE" <?php echo e($rendezVous->statut_production === 'LIVRE' ? 'selected' : ''); ?>>7. Livré au client</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary-custom-lg w-100" style="margin-top:0.5rem;">
                                <i class="fas fa-sync-alt me-2"></i> Mettre à jour l'étape
                            </button>
                        </form>
                    </div>

                <?php else: ?>

                    <div class="step-card">
                        <div class="banner-refused" style="<?php echo e($lastWa && $lastWa->statut === 'A_ENVOYER' ? 'background: linear-gradient(135deg, #f8d7da, #fbcfe8); border-color: #f43f5e; color: #9f1239;' : ''); ?>">
                            <?php if($lastWa && $lastWa->statut === 'A_ENVOYER'): ?>
                                <i class="fas fa-exclamation-circle fa-lg"></i>
                                Ce rendez-vous a été refusé. N'oubliez pas d'envoyer le message de refus par WhatsApp.
                            <?php else: ?>
                                <i class="fas fa-times-circle fa-lg"></i>
                                Ce rendez-vous a été refusé. Le client a été notifié par WhatsApp.
                            <?php endif; ?>
                        </div>
                    </div>

                <?php endif; ?>

            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\projet laravel\couture-app\resources\views/admin/rendezvous/show.blade.php ENDPATH**/ ?>