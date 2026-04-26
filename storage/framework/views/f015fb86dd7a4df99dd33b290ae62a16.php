

<?php $__env->startSection('title', 'Mes rendez-vous - Couture App'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <h2 class="mb-0"><i class="fas fa-calendar-check me-2" style="color: var(--primary);"></i>Mes rendez-vous</h2>
            <a href="<?php echo e(route('rendezvous.create')); ?>" class="btn btn-primary-custom btn-sm">
                <i class="fas fa-calendar-plus me-2"></i>Nouveau rendez-vous
            </a>
        </div>

        <div class="card-custom">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: var(--gray-100);">
                        <tr>
                            <th>Vêtement</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Statut</th>
                            <th>Commentaire</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $rendezVous; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rdv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><strong><?php echo e($rdv->vetement?->nom ?? '—'); ?></strong></td>
                                <td><?php echo e($rdv->dateRendezVous?->format('d/m/Y')); ?></td>
                                <td><?php echo e($rdv->heure); ?></td>
                                <td>
                                    <?php if($rdv->statut === \App\Models\RendezVous::STATUT_CONFIRME): ?>
                                        <span class="badge bg-success">Confirmé</span>
                                    <?php elseif($rdv->statut === \App\Models\RendezVous::STATUT_REFUSE): ?>
                                        <span class="badge bg-danger">Refusé</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">En attente</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-muted small"><?php echo e(\Illuminate\Support\Str::limit($rdv->commentaire ?? '—', 60)); ?></td>
                                <td>
                                    <?php if($rdv->statut === \App\Models\RendezVous::STATUT_CONFIRME): ?>
                                        <form action="<?php echo e(route('rendezvous.confirm', $rdv->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <button type="submit" class="btn btn-sm btn-success">Confirmer</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-calendar-xmark fa-2x mb-3 d-block opacity-50"></i>
                                    Aucun rendez-vous pour le moment.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\Desktop\projet laravel\couture-app\resources\views/rendezvous/index.blade.php ENDPATH**/ ?>