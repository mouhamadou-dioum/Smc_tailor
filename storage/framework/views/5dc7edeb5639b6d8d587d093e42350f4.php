<?php $__env->startSection('title', 'Admin - Catégories'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestion des Catégories</h2>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-outline-custom">
                <i class="fas fa-arrow-left me-2"></i> Retour
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-custom alert-success-custom mb-4">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="form-custom">
                    <h4 class="mb-3">Ajouter une catégorie</h4>
                    <form method="POST" action="<?php echo e(route('admin.categories.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label-custom">Nom *</label>
                            <input type="text" name="nom" class="form-control form-control-custom" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Description</label>
                            <textarea name="description" class="form-control form-control-custom" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100">
                            <i class="fas fa-plus me-2"></i> Ajouter
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card-custom">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background-color: var(--gray-100);">
                                <tr>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Vêtements</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><strong><?php echo e($categorie->nom); ?></strong></td>
                                    <td><?php echo e($categorie->description ?? '-'); ?></td>
                                    <td><?php echo e($categorie->vetements->count()); ?></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button onclick="editCategorie(<?php echo e($categorie->id); ?>, '<?php echo e($categorie->nom); ?>', '<?php echo e($categorie->description); ?>')" 
                                                    class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button onclick="deleteCategorie(<?php echo e($categorie->id); ?>)" 
                                                    class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        Aucune catégorie.
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="editForm">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Modifier la catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label-custom">Nom *</label>
                        <input type="text" name="nom" id="editNom" class="form-control form-control-custom" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Description</label>
                        <textarea name="description" id="editDescription" class="form-control form-control-custom" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary-custom">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function editCategorie(id, nom, description) {
    document.getElementById('editNom').value = nom;
    document.getElementById('editDescription').value = description || '';
    document.getElementById('editForm').action = '/admin/categories/' + id;
    new bootstrap.Modal(document.getElementById('editModal')).show();
}

function deleteCategorie(id) {
    if (confirm('Voulez-vous vraiment supprimer cette catégorie?')) {
        fetch(`/admin/categories/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Content-Type': 'application/json'
            }
        })
        .then(() => location.reload());
    }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\Desktop\projet laravel\couture-app\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>