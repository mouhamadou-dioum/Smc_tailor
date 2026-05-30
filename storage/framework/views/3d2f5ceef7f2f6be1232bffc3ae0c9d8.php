<?php $__env->startSection('title', 'Admin - Ajouter un tissu'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .admin-page {
        padding: 2.5rem 0 4rem;
        min-height: 80vh;
        background: var(--gray-100);
    }

    .page-header {
        background: linear-gradient(135deg, var(--dark) 0%, #2d2d4a 100%);
        border-radius: 20px;
        padding: 2rem 2.5rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 8px 32px rgba(26,26,46,0.18);
    }

    .page-title {
        color: #fff;
        font-family: 'Playfair Display', serif;
        font-size: 1.7rem;
        margin: 0;
    }

    .btn-back {
        border: 1.5px solid rgba(255,255,255,0.3);
        color: #fff;
        background: rgba(255,255,255,0.07);
        padding: 0.5rem 1.15rem;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.25s;
    }

    .btn-back:hover {
        background: rgba(255,255,255,0.15);
        color: #fff;
        transform: translateX(-3px);
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-page">
    <div class="container">
        
        <div class="page-header">
            <h2 class="page-title"><i class="fas fa-scissors me-2"></i>Ajouter un nouveau tissu</h2>
            <a href="<?php echo e(route('admin.tissus.index')); ?>" class="btn-back">
                <i class="fas fa-arrow-left me-1"></i> Retour
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-custom">
                    <form action="<?php echo e(route('admin.tissus.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="row">
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom" for="nom">Nom du tissu *</label>
                                <input 
                                    type="text" 
                                    name="nom" 
                                    id="nom" 
                                    class="form-control form-control-custom <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    placeholder="Ex: Wax Hollandais Premium, Bazin Riche Getzner" 
                                    value="<?php echo e(old('nom')); ?>" 
                                    required
                                >
                                <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger small"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom" for="type">Matière / Type *</label>
                                <select 
                                    name="type" 
                                    id="type" 
                                    class="form-select form-control-custom <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    required
                                >
                                    <option value="">Sélectionner un type</option>
                                    <?php $__currentLoopData = ['Wax', 'Bazin', 'Coton', 'Soie', 'Dentelle', 'Lin', 'Broderie', 'Velours', 'Laine']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($opt); ?>" <?php echo e(old('type') === $opt ? 'selected' : ''); ?>><?php echo e($opt); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <option value="Autre" <?php echo e(old('type') === 'Autre' ? 'selected' : ''); ?>>Autre / Matière spéciale</option>
                                </select>
                                <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger small"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row">
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom" for="prix_metre">Prix au mètre (CFA)</label>
                                <input 
                                    type="number" 
                                    name="prix_metre" 
                                    id="prix_metre" 
                                    class="form-control form-control-custom <?php $__errorArgs = ['prix_metre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    placeholder="Ex: 5000 (facultatif)" 
                                    value="<?php echo e(old('prix_metre')); ?>" 
                                    min="0"
                                >
                                <?php $__errorArgs = ['prix_metre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger small"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom" for="image_tissu">Photo du tissu</label>
                                <input 
                                    type="file" 
                                    name="image_tissu" 
                                    id="image_tissu" 
                                    class="form-control form-control-custom <?php $__errorArgs = ['image_tissu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    accept="image/*"
                                >
                                <?php $__errorArgs = ['image_tissu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger small"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        
                        <div class="mb-4">
                            <label class="form-label-custom" for="description">Description & Détails</label>
                            <textarea 
                                name="description" 
                                id="description" 
                                class="form-control form-control-custom <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                rows="4" 
                                placeholder="Couleur, motif, recommandations, tissage..."
                            ><?php echo e(old('description')); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger small"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    name="disponible" 
                                    id="disponible" 
                                    value="1" 
                                    checked
                                >
                                <label class="form-check-label fw-bold text-muted" for="disponible">
                                    Disponible immédiatement dans le catalogue client
                                </label>
                            </div>
                        </div>

                        
                        <button type="submit" class="btn btn-primary-custom w-100">
                            <i class="fas fa-save me-2"></i> Enregistrer le tissu
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\projet laravel\couture-app\resources\views/admin/tissus/create.blade.php ENDPATH**/ ?>