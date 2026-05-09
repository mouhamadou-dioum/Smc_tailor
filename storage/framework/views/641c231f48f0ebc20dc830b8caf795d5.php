<?php $__env->startSection('title', 'Admin - Rendez-vous'); ?>

<?php $__env->startSection('content'); ?>

<?php
    $admin = \App\Models\Admin::first();
    $adminPhone = '';
    if ($admin && $admin->telephone) {
        $adminPhone = preg_replace('/\D/', '', $admin->telephone);
        if (!str_starts_with($adminPhone, '221')) {
            $adminPhone = '221' . ltrim($adminPhone, '0');
        }
    }
?>

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
        grid-template-columns: auto 1fr auto auto auto;
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
    .rdv-info .rdv-client {
        font-size: 1rem;
        font-weight: 700;
        color: var(--dark);
        font-family: 'Playfair Display', serif;
    }
    .rdv-info .rdv-phone {
        font-size: 0.78rem;
        color: var(--gray-600);
        margin-top: 2px;
    }
    .rdv-info .rdv-vetement {
        font-size: 0.82rem;
        color: var(--gray-600);
        margin-top: 4px;
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

    /* WhatsApp status */
    .wa-status {}
    .wa-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.3rem 0.8rem;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 600;
    }
    .wa-badge.sent { background: #dcfce7; color: #166534; }
    .wa-badge.failed { background: #fee2e2; color: #991b1b; }
    .wa-badge.none { background: var(--gray-100); color: var(--gray-600); }

    /* Actions */
    .rdv-actions { display: flex; gap: 0.5rem; flex-wrap: wrap; }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px; height: 36px;
        border-radius: 50%;
        border: 1.5px solid var(--gray-300);
        background: #fff;
        color: var(--gray-600);
        text-decoration: none;
        font-size: 0.85rem;
        transition: all 0.2s;
    }
    .btn-action:hover { transform: translateY(-1px); }
    .btn-action.view:hover { border-color: var(--primary); color: var(--primary); background: #fef9ef; }
    .btn-action.confirm:hover { border-color: #22c55e; color: #22c55e; background: #f0fdf4; }
    .btn-action.reject:hover { border-color: #ef4444; color: #ef4444; background: #fef2f2; }
    .btn-action.wa { border-color: #bbf7d0; color: #25d366; background: #f0fdf4; }
    .btn-action.wa:hover { background: #25d366; color: #fff; border-color: #25d366; }

    /* Empty state */
    .empty-state {
        background: #fff;
        border-radius: 16px;
        padding: 4rem 2rem;
        text-align: center;
        border: 2px dashed var(--gray-300);
    }
    .empty-state i { font-size: 3rem; color: var(--gray-300); margin-bottom: 1rem; }

    .confirme-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        color: #166534;
        font-size: 0.82rem;
        font-weight: 700;
    }

    @media (max-width: 992px) {
        .rdv-card {
            grid-template-columns: auto 1fr;
            grid-template-rows: auto auto auto;
        }
        .rdv-actions { grid-column: 1 / -1; justify-content: flex-start; }
        .wa-status { grid-column: 1; }
    }
</style>

<div class="rdv-page">
    <div class="container">

        
        <div class="rdv-header">
            <div>
                <h2><i class="fas fa-calendar-cog"></i> Gestion des Rendez-vous</h2>
                <div class="subtitle">Gérez et suivez toutes les réservations de l'atelier</div>
            </div>
            <span class="badge bg-warning fs-6" style="color:#92400e;">
                <i class="fas fa-clock me-1"></i>
                <?php echo e($rendezVous->where('statut', 'EN_ATTENTE')->count()); ?> en attente
            </span>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-custom alert-success-custom mb-4">
                <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        
        <div class="rdv-grid">
            <?php $__empty_1 = true; $__currentLoopData = $rendezVous; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rdv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $dateObj = $rdv->dateRendezVous;
                $client = $rdv->client;

                $statutClass = match($rdv->statut) {
                    \App\Models\RendezVous::STATUT_CONFIRME => 'statut-confirme',
                    \App\Models\RendezVous::STATUT_REFUSE   => 'statut-refuse',
                    default                                 => 'statut-attente',
                };

                $lastWa = $rdv->notifications
                    ->where('type', 'WHATSAPP')
                    ->sortByDesc('dateEnvoi')
                    ->first();

                $rawPhone = $client->telephone ?? '';
                $phone = preg_replace('/\D/', '', $rawPhone);
                if ($phone && !str_starts_with($phone, '221')) {
                    $phone = '221' . ltrim($phone, '0');
                }
                $waText = urlencode(
                    "Bonjour {$client->prenom}, je vous contacte concernant votre rendez-vous du {$dateObj->format('d/m/Y')} à {$rdv->heure}."
                );
                $waLink = $phone ? 'https://wa.me/' . $phone . '?text=' . $waText : null;
            ?>
            <div class="rdv-card <?php echo e($statutClass); ?>">

                
                <div class="rdv-date-block">
                    <div class="day"><?php echo e($dateObj->format('d')); ?></div>
                    <div class="month"><?php echo e($dateObj->translatedFormat('M Y')); ?></div>
                    <div class="time"><i class="fas fa-clock fa-xs me-1"></i><?php echo e($rdv->heure); ?></div>
                </div>

                
                <div class="rdv-info">
                    <div class="rdv-client">
                        <?php echo e($client->prenom); ?> <?php echo e($client->nom); ?>

                    </div>
                    <div class="rdv-phone">
                        <i class="fas fa-phone fa-xs me-1"></i><?php echo e($client->telephone ?? 'N/A'); ?>

                    </div>
                    <div class="rdv-vetement">
                        <i class="fas fa-tshirt fa-xs me-1"></i>
                        <?php echo e($rdv->vetement->nom ?? 'À définir'); ?>

                    </div>
                </div>

                
                <div>
                    <?php if($rdv->statut === \App\Models\RendezVous::STATUT_CONFIRME): ?>
                        <span class="status-pill confirme">
                            <i class="fas fa-check-circle"></i> Confirmé
                        </span>
                    <?php elseif($rdv->statut === \App\Models\RendezVous::STATUT_REFUSE): ?>
                        <span class="status-pill refuse">
                            <i class="fas fa-times-circle"></i> Refusé
                        </span>
                    <?php else: ?>
                        <span class="status-pill attente">
                            <i class="fas fa-hourglass-half"></i> En attente
                        </span>
                    <?php endif; ?>
                </div>

                
                <div class="wa-status">
                    <?php if($lastWa): ?>
                        <?php if($lastWa->statut === 'ENVOYE'): ?>
                            <span class="wa-badge sent" title="<?php echo e($lastWa->dateEnvoi->format('d/m/Y H:i')); ?>">
                                <i class="fab fa-whatsapp"></i> Envoyé
                            </span>
                            <div class="text-muted" style="font-size:0.7rem;margin-top:3px;"><?php echo e($lastWa->dateEnvoi->diffForHumans()); ?></div>
                        <?php else: ?>
                            <span class="wa-badge failed" title="Échec d'envoi">
                                <i class="fas fa-exclamation-triangle"></i> Échec
                            </span>
                            <div class="text-muted" style="font-size:0.7rem;margin-top:3px;"><?php echo e($lastWa->dateEnvoi->diffForHumans()); ?></div>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="wa-badge none">—</span>
                    <?php endif; ?>
                </div>

                
                <div class="rdv-actions">
                    <?php if($waLink): ?>
                        <a href="<?php echo e($waLink); ?>" target="_blank" class="btn-action wa" title="Contacter sur WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    <?php endif; ?>

                    <a href="<?php echo e(route('admin.rendezvous.show', $rdv->id)); ?>" class="btn-action view" title="Voir détails">
                        <i class="fas fa-eye"></i>
                    </a>

                    <?php if($rdv->statut === \App\Models\RendezVous::STATUT_EN_ATTENTE): ?>
                        <a href="<?php echo e(route('admin.rendezvous.confirmer', $rdv->id)); ?>"
                           class="btn-action confirm" title="Confirmer — envoie un WhatsApp au client"
                           onclick="return confirm('Confirmer ce RDV ? Un WhatsApp de confirmation sera envoyé au client.')">
                            <i class="fas fa-check"></i>
                        </a>
                        <a href="<?php echo e(route('admin.rendezvous.refuser', $rdv->id)); ?>"
                           class="btn-action reject" title="Refuser — envoie un WhatsApp au client"
                           onclick="return confirm('Refuser ce RDV ? Un WhatsApp sera envoyé au client.')">
                            <i class="fas fa-times"></i>
                        </a>
                    <?php endif; ?>
                </div>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty-state">
                <i class="fas fa-calendar-xmark d-block"></i>
                <h5 style="font-family:'Playfair Display',serif; color:var(--dark);">Aucun rendez-vous</h5>
                <p class="text-muted mb-4">Aucun rendez-vous n'a été enregistré pour le moment.</p>
            </div>
            <?php endif; ?>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\projet laravel\couture-app\resources\views/admin/rendezvous/index.blade.php ENDPATH**/ ?>