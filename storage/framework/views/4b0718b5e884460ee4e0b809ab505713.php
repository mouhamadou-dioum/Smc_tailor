<?php $__env->startSection('title', 'Admin - Tableau de bord'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <h2 class="mb-0">Tableau de bord Admin</h2>
            <div class="d-flex gap-2 flex-wrap">
                <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-outline-custom btn-sm">
                    <i class="fas fa-tags me-1"></i> Catégories
                </a>
                <form action="<?php echo e(route('admin.logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-outline-custom btn-sm">Déconnexion</button>
                </form>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="card-custom p-3 p-md-4 text-center">
                    <i class="fas fa-tshirt" style="font-size: 2rem; color: var(--primary);"></i>
                    <h3 class="mt-2"><?php echo e($stats['vetements']); ?></h3>
                    <p class="text-muted mb-0">Vêtements</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card-custom p-3 p-md-4 text-center">
                    <i class="fas fa-users" style="font-size: 2rem; color: var(--primary);"></i>
                    <h3 class="mt-2"><?php echo e($stats['clients']); ?></h3>
                    <p class="text-muted mb-0">Clients</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card-custom p-3 p-md-4 text-center">
                    <i class="fas fa-calendar-alt" style="font-size: 2rem; color: var(--primary);"></i>
                    <h3 class="mt-2"><?php echo e($stats['rendezVous']); ?></h3>
                    <p class="text-muted mb-0">Rendez-vous</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card-custom p-3 p-md-4 text-center">
                    <i class="fas fa-clock" style="font-size: 2rem; color: #ffc107;"></i>
                    <h3 class="mt-2"><?php echo e($stats['enAttente']); ?></h3>
                    <p class="text-muted mb-0">En attente</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card-custom p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Derniers vêtements</h4>
                        <a href="<?php echo e(route('admin.vetements.index')); ?>" class="btn btn-outline-custom btn-sm">Voir tout</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prix</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $vetements->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vetement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($vetement->nom); ?></td>
                                    <td><?php echo e(number_format($vetement->prix, 0, ',', ' ')); ?> CFA</td>
                                    <td>
                                        <?php if($vetement->disponible): ?>
                                            <span class="badge bg-success">Disponible</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Indisponible</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card-custom p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Rendez-vous récents</h4>
                        <a href="<?php echo e(route('admin.rendezvous.index')); ?>" class="btn btn-outline-custom btn-sm">Voir tout</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Date</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $rendezVous->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rdv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($rdv->client->nom); ?></td>
                                    <td><?php echo e($rdv->dateRendezVous->format('d/m/Y')); ?></td>
                                    <td>
                                        <?php if($rdv->statut === 'EN_ATTENTE'): ?>
                                            <span class="badge badge-waiting">En attente</span>
                                        <?php elseif($rdv->statut === 'CONFIRME'): ?>
                                            <span class="badge badge-confirmed">Confirmé</span>
                                        <?php else: ?>
                                            <span class="badge badge-rejected">Refusé</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.rendezvous.show', $rdv->id)); ?>" class="btn btn-sm btn-primary-custom">Voir</a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\Desktop\projet laravel\couture-app\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>