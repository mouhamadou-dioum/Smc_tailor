<?php $__env->startSection('title', 'Admin - Tableau de bord'); ?>

<?php $__env->startSection('content'); ?>


<div class="rdv-page">
    <div class="container">

        
        

        
        <br>
        <br>
        <div class="row g-4 mb-4">

            <div class="col-md-3">
                <div class="rdv-card stat-card">
                    <i class="fas fa-tshirt"></i>
                    <h3><?php echo e($stats['vetements']); ?></h3>
                    <p>Vêtements</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="rdv-card stat-card">
                    <i class="fas fa-users"></i>
                    <h3><?php echo e($stats['clients']); ?></h3>
                    <p>Clients</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="rdv-card stat-card statut-attente">
                    <i class="fas fa-calendar-alt"></i>
                    <h3><?php echo e($stats['rendezVous']); ?></h3>
                    <p>Rendez-vous</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="rdv-card stat-card statut-attente">
                    <i class="fas fa-clock"></i>
                    <h3><?php echo e($stats['enAttente']); ?></h3>
                    <p>En attente</p>
                </div>
            </div>

        </div>

        
        <div class="row g-4">

            
            <div class="col-lg-6">
                <div class="card-custom p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <h4><i class="fas fa-tshirt me-2"></i> Derniers vêtements</h4>
                        <a href="<?php echo e(route('admin.vetements.index')); ?>" class="btn btn-sm btn-outline-dark">Voir tout</a>
                    </div>

                    <?php $__currentLoopData = $vetements->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vetement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="rdv-card list-card d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?php echo e($vetement->nom); ?></strong><br>
                                <small><?php echo e(number_format($vetement->prix, 0, ',', ' ')); ?> CFA</small>
                            </div>

                            <?php if($vetement->disponible): ?>
                                <span class="status-pill confirme">Disponible</span>
                            <?php else: ?>
                                <span class="status-pill refuse">Indisponible</span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            
            <div class="col-lg-6">
                <div class="card-custom p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <h4><i class="fas fa-calendar-alt me-2"></i> Rendez-vous récents</h4>
                        <a href="<?php echo e(route('admin.rendezvous.index')); ?>" class="btn btn-sm btn-outline-dark">Voir tout</a>
                    </div>

                    <?php $__currentLoopData = $rendezVous->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rdv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php
                            $class = match($rdv->statut) {
                                \App\Models\RendezVous::STATUT_CONFIRME => 'statut-confirme',
                                \App\Models\RendezVous::STATUT_REFUSE => 'statut-refuse',
                                default => 'statut-attente',
                            };
                        ?>

                        <div class="rdv-card list-card <?php echo e($class); ?> d-flex justify-content-between align-items-center">

                            <div>
                                <strong><?php echo e($rdv->client->prenom); ?> <?php echo e($rdv->client->nom); ?></strong><br>
                                <small><?php echo e($rdv->dateRendezVous->format('d/m/Y')); ?> - <?php echo e($rdv->heure); ?></small>
                            </div>

                            <div class="d-flex align-items-center gap-2">

                                <?php if($rdv->statut === \App\Models\RendezVous::STATUT_CONFIRME): ?>
                                    <span class="status-pill confirme">Confirmé</span>
                                <?php elseif($rdv->statut === \App\Models\RendezVous::STATUT_REFUSE): ?>
                                    <span class="status-pill refuse">Refusé</span>
                                <?php else: ?>
                                    <span class="status-pill attente">En attente</span>
                                <?php endif; ?>

                                <a href="<?php echo e(route('admin.rendezvous.show', $rdv->id)); ?>" class="btn-action">
                                    <i class="fas fa-eye"></i>
                                </a>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>

        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\Desktop\projet laravel\couture-app\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>