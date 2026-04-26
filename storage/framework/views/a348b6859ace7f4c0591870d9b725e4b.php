<?php $__env->startSection('title', 'Admin - Vêtements'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <h2 class="mb-0">Gestion des Vêtements</h2>
            <a href="<?php echo e(route('admin.vetements.create')); ?>" class="btn btn-primary-custom btn-sm">
                <i class="fas fa-plus me-2"></i> Ajouter
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-custom alert-success-custom mb-4">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="card-custom">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: var(--gray-100);">
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th>Prix</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $vetements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vetement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr id="row-<?php echo e($vetement->id); ?>">
                            <td>
                                <img src="<?php echo e($vetement->imageUrl); ?>" alt="<?php echo e($vetement->nom); ?>" 
                                     class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                            </td>
                            <td><strong><?php echo e($vetement->nom); ?></strong></td>
                            <td><?php echo e($vetement->categorie->nom ?? '-'); ?></td>
                            <td><?php echo e(number_format($vetement->prix, 0, ',', ' ')); ?> CFA</td>
                            <td>
                                <?php if($vetement->disponible): ?>
                                    <span class="badge bg-success">Disponible</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Indisponible</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="<?php echo e(route('admin.vetements.edit', $vetement->id)); ?>" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="deleteVetement(<?php echo e($vetement->id); ?>)" 
                                            class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Aucun vêtement pour le moment.
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

<?php $__env->startSection('scripts'); ?>
<script>
function deleteVetement(id) {
    if (confirm('Voulez-vous vraiment supprimer ce vêtement?')) {
        fetch(`/admin/vetements/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById(`row-${id}`).remove();
            alert('Vêtement supprimé!');
        });
    }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\Desktop\projet laravel\couture-app\resources\views/admin/vetements/index.blade.php ENDPATH**/ ?>