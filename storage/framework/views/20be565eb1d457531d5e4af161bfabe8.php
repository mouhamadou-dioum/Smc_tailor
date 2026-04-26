<?php $__env->startSection('title', 'Nos Vêtements - Couture App'); ?>

<?php $__env->startSection('content'); ?>
<section class="py-5" style="background: var(--dark);">
    <div class="container text-center">
        <h1 class="hero-title">Nos Créations</h1>
        <p class="hero-subtitle">Découvrez notre collection exclusive</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <?php if($categories->count() > 0): ?>
        <div class="mb-5 overflow-auto">
            <div class="d-flex flex-nowrap flex-md-wrap justify-content-center gap-2">
                <a href="<?php echo e(route('vetements.index')); ?>" 
                   class="btn <?php echo e(!$categorieId ? 'btn-primary-custom' : 'btn-outline-custom'); ?> btn-sm">
                    Tous
                </a>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('vetements.index', ['categorie' => $categorie->id])); ?>" 
                       class="btn <?php echo e($categorieId == $categorie->id ? 'btn-primary-custom' : 'btn-outline-custom'); ?> btn-sm">
                        <?php echo e($categorie->nom); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="row g-4">
            <?php $__empty_1 = true; $__currentLoopData = $vetements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vetement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card-custom h-100">
                        <div class="position-relative">
                           <img
    src="<?php echo e($vetement->imageUrl ?: 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=800'); ?>"
    alt="<?php echo e($vetement->nom); ?>"
    class="img-fluid w-100"
    style="height: 350px; object-fit: cover; object-position: top center;"
    onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1445205170230-053b83016050?w=800';"
>
                            <?php if(!$vetement->disponible): ?>
                                <span class="badge bg-secondary position-absolute top-0 end-0 m-2">Indisponible</span>
                            <?php endif; ?>
                            <span class="price-tag position-absolute bottom-0 start-0 m-2"><?php echo e(number_format($vetement->prix, 0, ',', ' ')); ?> CFA</span>
                        </div>
                        <div class="p-4">
                            <h5 class="mb-2"><?php echo e($vetement->nom); ?></h5>
                            <p class="text-muted small mb-3"><?php echo e(\Illuminate\Support\Str::limit($vetement->description ?? '', 80)); ?></p>
                            <div class="d-flex gap-2 flex-column flex-sm-row">
                                <button class="btn btn-outline-custom flex-grow-1" data-bs-toggle="modal" data-bs-target="#vetementModal<?php echo e($vetement->id); ?>">
                                    <i class="fas fa-eye me-1"></i> Détails
                                </button>
                                <?php if($vetement->disponible): ?>
                                    <a href="<?php echo e(route('rendezvous.create')); ?>?vetement=<?php echo e($vetement->id); ?>" class="btn btn-primary-custom flex-grow-1">
                                        <i class="fas fa-calendar-plus me-1"></i> Réserver
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="vetementModal<?php echo e($vetement->id); ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img
                                            src="<?php echo e($vetement->imageUrl ?: 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=1200'); ?>"
                                            alt="<?php echo e($vetement->nom); ?>"
                                            class="img-fluid rounded"
                                            onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1445205170230-053b83016050?w=1200';"
                                        >
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="mb-3"><?php echo e($vetement->nom); ?></h3>
                                        <?php if($vetement->categorie): ?>
                                            <span class="badge badge-admin mb-2"><?php echo e($vetement->categorie->nom); ?></span>
                                        <?php endif; ?>
                                        <span class="price-tag mb-3 d-inline-block"><?php echo e(number_format($vetement->prix, 0, ',', ' ')); ?> CFA</span>
                                        <p class="mt-3"><?php echo e($vetement->description); ?></p>
                                        <div class="mt-4">
                                            <?php if($vetement->disponible): ?>
                                                <a href="<?php echo e(route('rendezvous.create')); ?>?vetement=<?php echo e($vetement->id); ?>" class="btn btn-primary-custom">
                                                    <i class="fas fa-calendar-plus me-1"></i> Réserver ce vêtement
                                                </a>
                                            <?php else: ?>
                                                <button class="btn btn-secondary" disabled>Indisponible</button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-box-open" style="font-size: 4rem; color: var(--gray-400);"></i>
                    <p class="mt-3 text-muted">Aucun vêtement disponible pour le moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\Desktop\projet laravel\couture-app\resources\views/vetements/index.blade.php ENDPATH**/ ?>