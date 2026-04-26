<?php $__env->startSection('title', 'Admin - Connexion'); ?>

<?php $__env->startSection('content'); ?>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="text-center mb-4">
                    <h2>Connexion Admin</h2>
                    <p class="section-subtitle">Espace Administration</p>
                </div>
                <div class="form-custom">
                    <form method="POST" action="<?php echo e(route('admin.login')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label-custom">Email</label>
                            <input type="email" name="email" class="form-control form-control-custom" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Mot de passe</label>
                            <input type="password" name="motDePasse" class="form-control form-control-custom" required>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100">Se connecter</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="<?php echo e(route('home')); ?>" style="color: var(--primary);">← Retour au site</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\Desktop\projet laravel\couture-app\resources\views/admin/login.blade.php ENDPATH**/ ?>