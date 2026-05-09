

<?php $__env->startSection('title', 'Admin - Clients'); ?>

<?php $__env->startSection('content'); ?>
<div class="rdv-page">
    <div class="container">
        
        <div class="rdv-header">
            <div>
                <h2><i class="fas fa-users"></i> Clients inscrits</h2>
                <div class="subtitle">Gérez vos clients et suivez leurs activités</div>
            </div>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-outline-custom" style="color:#fff;border-color:rgba(255,255,255,0.3);">
                <i class="fas fa-arrow-left me-2"></i> Tableau de bord
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-custom alert-success-custom mb-4">
                <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        
        <div class="rdv-grid">
            <?php $__empty_1 = true; $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="rdv-card" style="grid-template-columns: auto 1fr auto;">
                
                <div class="rdv-date-block" style="min-width:50px;padding:0.5rem;">
                    <i class="fas fa-user-circle" style="font-size:2rem;color:var(--primary);"></i>
                </div>

                
                <div class="rdv-info">
                    <div class="rdv-client"><?php echo e($client->prenom); ?> <?php echo e($client->nom); ?></div>
                    <div class="rdv-phone">
                        <i class="fas fa-envelope fa-xs me-1"></i><?php echo e($client->email); ?>

                    </div>
                    <div class="rdv-comment">
                        <i class="fas fa-phone fa-xs me-1"></i><?php echo e($client->telephone ?? 'N/A'); ?>

                        <span class="ms-2">
                            <i class="fas fa-calendar fa-xs me-1"></i><?php echo e($client->dateInscription?->format('d/m/Y') ?? '—'); ?>

                        </span>
                    </div>
                </div>

                
                <div>
                    <span class="status-pill attente" style="font-size:0.7rem;">
                        <i class="fas fa-calendar-check me-1"></i><?php echo e($client->rendezVous->count()); ?> RDV
                    </span>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty-state">
                <i class="fas fa-users d-block"></i>
                <h5 style="font-family:'Playfair Display',serif; color:var(--dark);">Aucun client</h5>
                <p class="text-muted mb-0">Aucun client enregistré pour le moment.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\Desktop\projet laravel\couture-app\resources\views/admin/clients/index.blade.php ENDPATH**/ ?>