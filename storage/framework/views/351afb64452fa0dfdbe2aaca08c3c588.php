<?php $__env->startSection('title', 'Admin - Modifier le vêtement'); ?>

<?php $__env->startSection('content'); ?>
<div class="rdv-page">
    <div class="container">
        
        <div class="rdv-header">
            <div>
                <h2><i class="fas fa-edit"></i> Modifier le vêtement</h2>
                <div class="subtitle">Mettez à jour les informations du modèle</div>
            </div>
            <a href="<?php echo e(route('admin.vetements.index')); ?>" class="btn btn-outline-custom" style="color:#fff;border-color:rgba(255,255,255,0.3);">
                <i class="fas fa-arrow-left me-2"></i> Retour
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-custom">
                    <form method="POST" action="<?php echo e(route('admin.vetements.update', $vetement->id)); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Nom du vêtement *</label>
                            <input type="text" name="nom" class="form-control form-control-custom" 
                                   value="<?php echo e($vetement->nom); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Description</label>
                            <textarea name="description" class="form-control form-control-custom" rows="4"><?php echo e($vetement->description); ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Prix (CFA) *</label>
                                <input type="number" name="prix" class="form-control form-control-custom" 
                                       value="<?php echo e($vetement->prix); ?>" required min="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Catégorie</label>
                                <select name="categorie_id" class="form-control form-control-custom">
                                    <option value="">Aucune catégorie</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($categorie->id); ?>" <?php echo e($vetement->categorie_id == $categorie->id ? 'selected' : ''); ?>>
                                            <?php echo e($categorie->nom); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">URL de l'image</label>
                            <input type="url" name="imageUrl" class="form-control form-control-custom" 
                                   value="<?php echo e($vetement->imageUrl); ?>">
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="disponible" id="disponible" 
                                       <?php echo e($vetement->disponible ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="disponible">
                                    Disponible à la réservation
                                </label>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="fas fa-save me-2"></i> Mettre à jour
                            </button>
                            <a href="<?php echo e(route('admin.vetements.index')); ?>" class="btn btn-outline-custom">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\projet laravel\couture-app\resources\views/admin/vetements/edit.blade.php ENDPATH**/ ?>