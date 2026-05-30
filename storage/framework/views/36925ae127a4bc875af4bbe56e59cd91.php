<?php $__env->startSection('title', 'Admin - Tissus'); ?>

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

    .tissu-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        border: 1.5px solid var(--gray-200);
        padding: 1.25rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .tissu-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        border-color: var(--primary);
    }

    .tissu-image {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        object-fit: cover;
        background: var(--gray-100);
        flex-shrink: 0;
    }

    .tissu-info {
        flex: 1;
    }

    .tissu-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.1rem;
        color: var(--dark);
        margin-bottom: 0.25rem;
    }

    .tissu-meta {
        font-size: 0.85rem;
        color: var(--gray-600);
    }

    .tissu-price {
        font-weight: 600;
        color: var(--primary);
        font-size: 0.9rem;
    }

    .status-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .status-badge.disponible {
        background: rgba(40,167,69,0.15);
        color: #28a745;
    }

    .status-badge.indisponible {
        background: rgba(239,68,68,0.15);
        color: #ef4444;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .action-btn.edit {
        background: rgba(201,169,89,0.15);
        color: var(--primary);
    }

    .action-btn.edit:hover {
        background: var(--primary);
        color: white;
        transform: scale(1.1);
    }

    .action-btn.delete {
        background: rgba(239,68,68,0.15);
        color: #ef4444;
    }

    .action-btn.delete:hover {
        background: #ef4444;
        color: white;
        transform: scale(1.1);
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        background: var(--gray-100);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 2rem;
        color: var(--gray-400);
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-page">
    <div class="container">
        
        <div class="admin-header">
            <div>
                <h2><i class="fas fa-scissors"></i> Gestion des Tissus</h2>
                <div class="subtitle">Gérez les tissus et matières disponibles pour le sur-mesure</div>
            </div>
            <a href="<?php echo e(route('admin.tissus.create')); ?>" class="btn btn-primary-custom">
                <i class="fas fa-plus me-2"></i> Ajouter un tissu
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-custom alert-success-custom mb-4">
                <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        
        <div class="row g-3">
            <?php $__empty_1 = true; $__currentLoopData = $tissus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tissu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-6 col-lg-4" id="row-<?php echo e($tissu->id); ?>">
                <div class="tissu-card" style="flex-direction:column;align-items:stretch;">
                    <div class="d-flex align-items-center gap-3">
                        <img src="<?php echo e($tissu->image_url ?? 'data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect fill=%22%23f5f5f5%22 width=%22100%22 height=%22100%22/><text x=%2250%22 y=%2255%22 font-size=%2240%22 text-anchor=%22middle%22 fill=%22%23ccc%22>🧵</text></svg>'); ?>" alt="<?php echo e($tissu->nom); ?>" 
                             class="tissu-image" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect fill=%22%23f5f5f5%22 width=%22100%22 height=%22100%22/><text x=%2250%22 y=%2255%22 font-size=%2240%22 text-anchor=%22middle%22 fill=%22%23ccc%22>🧵</text></svg>'">
                        <div class="tissu-info">
                            <div class="tissu-title"><?php echo e($tissu->nom); ?></div>
                            <div class="tissu-meta">
                                <i class="fas fa-scissors fa-xs me-1"></i>Type : <?php echo e($tissu->type); ?>

                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3" style="border-top:1px solid var(--gray-200);">
                        <div class="d-flex align-items-center gap-3">
                            <span class="tissu-price">
                                <?php if($tissu->prix_metre): ?>
                                    <?php echo e(number_format($tissu->prix_metre, 0, ',', ' ')); ?> CFA/m
                                <?php else: ?>
                                    Non tarifé
                                <?php endif; ?>
                            </span>
                            <span class="status-badge <?php echo e($tissu->disponible ? 'disponible' : 'indisponible'); ?>">
                                <?php echo e($tissu->disponible ? 'Disponible' : 'Indisponible'); ?>

                            </span>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <a href="<?php echo e(route('admin.tissus.edit', $tissu->id)); ?>" class="action-btn edit" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <form action="<?php echo e(route('admin.tissus.destroy', $tissu->id)); ?>" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce tissu ?')" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="action-btn delete" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="empty-icon">
                        <i class="fas fa-scissors"></i>
                    </div>
                    <h4 style="font-family:'Playfair Display',serif; color:var(--dark);">Aucun tissu</h4>
                    <p class="text-muted">Commencez par ajouter votre premier tissu dans la collection.</p>
                    <a href="<?php echo e(route('admin.tissus.create')); ?>" class="btn btn-primary-custom mt-2">
                        <i class="fas fa-plus me-2"></i> Ajouter un tissu
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\projet laravel\couture-app\resources\views/admin/tissus/index.blade.php ENDPATH**/ ?>