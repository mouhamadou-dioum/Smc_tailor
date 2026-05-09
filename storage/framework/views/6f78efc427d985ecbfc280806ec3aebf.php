<?php $__env->startSection('title', 'Admin - Ajouter un vêtement'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .admin-page {
        padding: 1.5rem 0 4rem;
        min-height: 80vh;
        background: var(--gray-100);
    }

    .admin-header {
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

    .admin-header h2 {
        color: #fff;
        font-size: 1.7rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .admin-header h2 i { color: var(--primary); }
    
    .admin-header .subtitle {
        color: rgba(255,255,255,0.55);
        font-size: 0.85rem;
        margin-top: 0.2rem;
    }

    .admin-form {
        background: #fff;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .form-section-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.1rem;
        color: var(--dark);
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--gray-200);
    }

    .image-preview {
        width: 100%;
        height: 200px;
        border-radius: 12px;
        background: var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 2px dashed var(--gray-300);
    }

    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-preview i {
        font-size: 3rem;
        color: var(--gray-300);
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-page">
    <div class="container">
        
        <div class="admin-header">
            <div>
                <h2><i class="fas fa-plus-circle"></i> Ajouter un vêtement</h2>
                <div class="subtitle">Complétez les informations du nouveau modèle</div>
            </div>
            <a href="<?php echo e(route('admin.vetements.index')); ?>" class="btn btn-outline-custom" style="border-color: rgba(255,255,255,0.4); color: #fff;">
                <i class="fas fa-arrow-left me-2"></i> Retour
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="admin-form">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-custom alert-error-custom mb-4">
                            <ul class="mb-0 ps-3">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('admin.vetements.store')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        
                        <h5 class="form-section-title"><i class="fas fa-info-circle me-2" style="color:var(--primary);"></i>Informations générales</h5>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Nom du vêtement *</label>
                            <input type="text" name="nom" class="form-control form-control-custom" required placeholder="Ex: Costume mariage classique" value="<?php echo e(old('nom')); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Description</label>
                            <textarea name="description" class="form-control form-control-custom" rows="4" placeholder="Décrivez les caractéristiques du vêtement..."><?php echo e(old('description')); ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Prix (CFA) *</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background:var(--gray-100);border:2px solid var(--gray-200);border-right:none;border-radius:6px 0 0 6px;">₣</span>
                                    <input type="number" name="prix" class="form-control form-control-custom" required min="0" placeholder="25000" value="<?php echo e(old('prix')); ?>" style="border-radius:0 6px 6px 0;">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Catégorie</label>
                                <select name="categorie_id" class="form-control form-control-custom">
                                    <option value="">Sélectionner une catégorie</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($categorie->id); ?>" <?php echo e(old('categorie_id') == $categorie->id ? 'selected' : ''); ?>>
                                            <?php echo e($categorie->nom); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <h5 class="form-section-title mt-4"><i class="fas fa-image me-2" style="color:var(--primary);"></i>Image</h5>

                        <div class="mb-3">
                            <label class="form-label-custom">URL de l'image</label>
                            <input type="url" name="imageUrl" class="form-control form-control-custom" 
                                   placeholder="https://exemple.com/image.jpg" value="<?php echo e(old('imageUrl')); ?>">
                            <?php if(old('imageUrl')): ?>
                            <div class="mt-3 image-preview">
                                <img src="<?php echo e(old('imageUrl')); ?>" alt="Aperçu" onerror="this.parentElement.innerHTML='<i class=\'fas fa-image\'></i>'">
                            </div>
                            <?php else: ?>
                            <div class="mt-3 image-preview">
                                <i class="fas fa-image"></i>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="disponible" id="disponible" <?php echo e(old('disponible', true) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="disponible">
                                    Disponible à la réservation
                                </label>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="fas fa-save me-2"></i> Enregistrer
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
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\projet laravel\couture-app\resources\views/admin/vetements/create.blade.php ENDPATH**/ ?>