<?php $__env->startSection('title', 'Admin - Connexion'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .auth-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        padding: 2rem 0;
    }

    .auth-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        width: 100%;
        max-width: 450px;
    }

    .auth-logo {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary) !important;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 0.5rem;
    }

    .auth-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.75rem;
        color: #1a1a2e;
        margin-bottom: 0.5rem;
    }

    .auth-subtitle {
        color: #6c757d;
        font-size: 0.95rem;
        margin-bottom: 2rem;
    }

    .auth-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        display: block;
    }

    .auth-input {
        border: 2px solid #e9ecef;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        width: 100%;
    }

    .auth-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(201,169,89,0.2);
        outline: none;
    }

    .auth-btn {
        background: var(--primary);
        color: white;
        border: none;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s ease;
    }

    .auth-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }

    .auth-back {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        font-size: 0.9rem;
    }

    .auth-back:hover {
        color: #fff;
    }

    .password-toggle {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-left: none;
        border-radius: 0 8px 8px 0;
        padding: 0.5rem 0.75rem;
        cursor: pointer;
    }

    .password-toggle:hover {
        background: #e9ecef;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="text-center mb-4">
                    <a href="<?php echo e(route('home')); ?>" class="auth-logo">COUTURE</a>
                    <h1 class="auth-title">Administration</h1>
                    <p class="auth-subtitle">Connexion à l'espace admin</p>
                </div>
                
                <div class="auth-card">
                    <form method="POST" action="<?php echo e(route('admin.login')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label class="auth-label">Email</label>
                            <input type="email" name="email" class="auth-input" required placeholder="admin@email.com">
                        </div>
                        
                        <div class="mb-4">
                            <label class="auth-label">Mot de passe</label>
                            <div class="position-relative">
                                <input type="password" id="adminPwd" name="motDePasse" class="auth-input" required style="padding-right:45px;" placeholder="••••••••">
                                <button type="button" class="password-toggle position-absolute" onclick="togglePassword()" style="right:2px;top:50%;transform:translateY(-50%);border:none;background:transparent;">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>
                        
                        <button type="submit" class="auth-btn mb-3">Se connecter</button>
                    </form>
                </div>
                
                <div class="text-center mt-4">
                    <a href="<?php echo e(route('home')); ?>" class="auth-back">
                        <i class="fas fa-arrow-left me-1"></i> Retour au site
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startSection('scripts'); ?>
<script>
function togglePassword() {
    const input = document.getElementById('adminPwd');
    const icon = document.getElementById('toggleIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'fas fa-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'fas fa-eye';
    }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\projet laravel\couture-app\resources\views/admin/login.blade.php ENDPATH**/ ?>