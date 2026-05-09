<?php $__env->startSection('title', 'Admin - Détails du Rendez-vous'); ?>

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
        \App\Models\RendezVous::STATUT_CONFIRME => 'statut-confirme',
        \App\Models\RendezVous::STATUT_REFUSE   => 'statut-refuse',
        default                                 => 'statut-attente',
    };
?>

<div class="rdv-page">
    <div class="container">
        
        <div class="rdv-header">
            <div>
                <h2><i class="fas fa-calendar-check"></i> Détails du Rendez-vous</h2>
                <div class="subtitle">Informations complètes et actions</div>
            </div>
            <a href="<?php echo e(route('admin.rendezvous.index')); ?>" class="btn btn-outline-custom" style="color:#fff;border-color:rgba(255,255,255,0.3);">
                <i class="fas fa-arrow-left me-2"></i> Retour
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-custom alert-success-custom mb-4">
                <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="row">
            
            <div class="col-lg-6">
                
                <div class="rdv-card mb-3" style="grid-template-columns: auto 1fr auto;">
                    <div class="rdv-date-block" style="min-width:50px;padding:0.5rem;">
                        <i class="fas fa-user-circle" style="font-size:2rem;color:var(--primary);"></i>
                    </div>
                    <div class="rdv-info">
                        <div class="rdv-client"><?php echo e($rendezVous->client->prenom); ?> <?php echo e($rendezVous->client->nom); ?></div>
                        <div class="rdv-phone"><i class="fas fa-envelope fa-xs me-1"></i><?php echo e($rendezVous->client->email); ?></div>
                        <div class="rdv-comment"><i class="fas fa-phone fa-xs me-1"></i><?php echo e($rendezVous->client->telephone ?? 'Non renseigné'); ?></div>
                    </div>
                    <?php if($phone): ?>
                        <div class="rdv-actions">
                            <a href="https://wa.me/<?php echo e($phone); ?>" target="_blank" class="btn-action wa" title="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                
                <div class="rdv-card <?php echo e($statutClass); ?> mb-3" style="grid-template-columns: auto 1fr auto;">
                    <div class="rdv-date-block">
                        <div class="day"><?php echo e($rendezVous->dateRendezVous->format('d')); ?></div>
                        <div class="month"><?php echo e($rendezVous->dateRendezVous->translatedFormat('M Y')); ?></div>
                        <div class="time"><i class="fas fa-clock fa-xs me-1"></i><?php echo e($rendezVous->heure); ?></div>
                    </div>
                    <div class="rdv-info">
                        <div class="rdv-vetement"><?php echo e($rendezVous->vetement->nom ?? 'À définir'); ?></div>
                        <?php if($rendezVous->commentaire): ?>
                            <div class="rdv-comment"><?php echo e(Str::limit($rendezVous->commentaire, 70)); ?></div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <?php if($rendezVous->statut === \App\Models\RendezVous::STATUT_CONFIRME): ?>
                            <span class="status-pill confirme"><i class="fas fa-check-circle"></i> Confirmé</span>
                        <?php elseif($rendezVous->statut === \App\Models\RendezVous::STATUT_REFUSE): ?>
                            <span class="status-pill refuse"><i class="fas fa-times-circle"></i> Refusé</span>
                        <?php else: ?>
                            <span class="status-pill attente"><i class="fas fa-hourglass-half"></i> En attente</span>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div class="card-custom p-4">
                    <h5 class="mb-3" style="font-family:'Playfair Display',serif;">
                        <i class="fab fa-whatsapp text-success me-2"></i>Historique WhatsApp
                    </h5>
                    <?php if($waNotifs->isEmpty()): ?>
                        <p class="text-muted mb-0">Aucun message WhatsApp envoyé pour ce RDV.</p>
                    <?php else: ?>
                        <div class="rdv-grid" style="gap:0.5rem;">
                            <?php $__currentLoopData = $waNotifs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="rdv-card" style="padding:0.75rem 1rem;">
                                <div class="rdv-info">
                                    <?php if($notif->statut === 'ENVOYE'): ?>
                                        <span class="wa-badge sent"><i class="fab fa-whatsapp me-1"></i>Envoyé</span>
                                    <?php else: ?>
                                        <span class="wa-badge failed"><i class="fas fa-exclamation-triangle me-1"></i>Échec</span>
                                    <?php endif; ?>
                                    <div class="rdv-comment"><?php echo e(Str::limit($notif->contenu, 60)); ?></div>
                                </div>
                                <div class="text-muted" style="font-size:0.7rem;">
                                    <?php echo e($notif->dateEnvoi->format('d/m H:i')); ?><br>
                                    <?php echo e($notif->dateEnvoi->diffForHumans()); ?>

                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="col-lg-6">
                <?php if($rendezVous->statut === \App\Models\RendezVous::STATUT_EN_ATTENTE): ?>
                
                <div class="card-custom p-4 mb-3">
                    <h5 class="mb-2" style="font-family:'Playfair Display',serif;">
                        <span class="badge bg-secondary me-2">1</span>Discuter
                    </h5>
                    <p class="text-muted small mb-3">Contactez le client sur WhatsApp pour confirmer les détails.</p>
                    <?php if($phone): ?>
                        <a href="https://wa.me/<?php echo e($phone); ?>?text=<?php echo e($waDiscuss); ?>"
                           target="_blank" class="btn btn-success w-100">
                            <i class="fab fa-whatsapp me-2"></i>Ouvrir WhatsApp
                        </a>
                    <?php else: ?>
                        <p class="text-danger small mb-0"><i class="fas fa-exclamation-circle me-1"></i>Numéro non renseigné.</p>
                    <?php endif; ?>
                </div>

                
                <div class="card-custom p-4 mb-3">
                    <h5 class="mb-2" style="font-family:'Playfair Display',serif;">
                        <span class="badge bg-secondary me-2">2</span>Valider ou refuser
                    </h5>
                    <p class="text-muted small mb-3">Un WhatsApp sera envoyé au client.</p>
                    <div class="d-flex gap-3">
                        <a href="<?php echo e(route('admin.rendezvous.confirmer', $rendezVous->id)); ?>"
                           class="btn btn-success flex-grow-1"
                           onclick="return confirm('Confirmer ce RDV ?')">
                            <i class="fas fa-check me-2"></i>Confirmer
                        </a>
                        <a href="<?php echo e(route('admin.rendezvous.refuser', $rendezVous->id)); ?>"
                           class="btn btn-danger flex-grow-1"
                           onclick="return confirm('Refuser ce RDV ?')">
                            <i class="fas fa-times me-2"></i>Refuser
                        </a>
                    </div>
                </div>

                <?php elseif($rendezVous->statut === \App\Models\RendezVous::STATUT_CONFIRME): ?>
                <div class="card-custom p-4 mb-3">
                    <div class="alert alert-success-custom mb-3"><i class="fab fa-whatsapp me-2"></i>RDV confirmé</div>
                    <div class="d-flex gap-3">
                        <a href="<?php echo e(route('admin.mesures.create', $rendezVous->client_id)); ?>" class="btn btn-primary-custom flex-grow-1">
                            <i class="fas fa-ruler me-2"></i>Mesures
                        </a>
                        <a href="<?php echo e(route('admin.mesures.historique', $rendezVous->client_id)); ?>" class="btn btn-outline-custom flex-grow-1">
                            <i class="fas fa-history me-2"></i>Historique
                        </a>
                    </div>
                </div>

                <?php else: ?>
                <div class="card-custom p-4">
                    <div class="alert alert-error-custom mb-0"><i class="fab fa-whatsapp me-2"></i>RDV refusé</div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\Desktop\projet laravel\couture-app\resources\views/admin/rendezvous/show.blade.php ENDPATH**/ ?>