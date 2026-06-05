<?php $__env->startSection('title', 'Connexion - Couture App'); ?>

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
        font-size: 2.5rem;
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

    .auth-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
    }

    .auth-link:hover {
        text-decoration: underline;
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

    /* =====================================================
       CORRECTIF #2 — Double icône "œil" sur le champ password
       -------------------------------------------------------
       Chrome, Edge et Safari injectent nativement leur icône
       d'œil sur les champs type="password". On la désactive
       pour ne conserver que l'icône Font Awesome personnalisée.
    ===================================================== */

    /* Masque l'icône native de Edge / IE */
    .auth-input[type="password"]::-ms-reveal,
    .auth-input[type="password"]::-ms-clear {
        display: none !important;
    }

    /* Masque l'icône native de Chrome / Edge Chromium */
    .auth-input[type="password"]::-webkit-credentials-auto-fill-button,
    .auth-input[type="password"]::-webkit-strong-password-auto-fill-button,
    .auth-input[type="password"]::-webkit-contacts-auto-fill-button {
        display: none !important;
        pointer-events: none;
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
                    <h1 class="auth-title">Connexion</h1>
                    <p class="auth-subtitle">Accédez à votre compte client</p>
                </div>
                
                <div class="auth-card">
                    <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="alert alert-info small mb-4 py-2 px-3 border-0 rounded-3" style="background-color: rgba(201,169,89,0.08); color: var(--gold-dark); font-size: 0.85rem; line-height: 1.4;">
                            <i class="fas fa-info-circle me-1"></i>
                            Si vous avez réservé sans compte, connectez-vous avec votre numéro de <strong>téléphone</strong> et le mot de passe <strong>password</strong>.
                        </div>

                        <div class="mb-3">
                            <label class="auth-label">Email ou Téléphone *</label>
                            <input type="text" name="login" class="auth-input" required placeholder="votre@email.com ou 771234567" value="<?php echo e(old('login')); ?>">
                            <?php $__errorArgs = ['login'];
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
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="auth-label mb-0">Mot de passe *</label>
                                <a href="<?php echo e(route('password.request')); ?>" class="auth-link small" style="font-size: 0.85rem;">Mot de passe oublié ?</a>
                            </div>
                            <div class="position-relative">
                                
                                <input
                                    type="password"
                                    id="motDePasse"
                                    name="motDePasse"
                                    class="auth-input"
                                    required
                                    autocomplete="current-password"
                                    style="padding-right:45px;"
                                    placeholder="••••••••"
                                >
                                <button
                                    type="button"
                                    class="password-toggle position-absolute"
                                    onclick="togglePassword()"
                                    style="right:2px;top:50%;transform:translateY(-50%);border:none;background:transparent;"
                                    aria-label="Afficher / masquer le mot de passe"
                                >
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                            <?php $__errorArgs = ['motDePasse'];
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
                        
                        <button type="submit" class="auth-btn mb-3">Se connecter</button>
                    </form>
                    
                    <p class="text-center" style="color:#6c757d;">
                        Pas de compte? <a href="<?php echo e(route('register')); ?>" class="auth-link">S'inscrire</a>
                    </p>
                </div>
                
                <div class="text-center mt-4">
                    <a href="<?php echo e(route('home')); ?>" class="auth-back">
                        <i class="fas fa-arrow-left me-1"></i> Retour à l'accueil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script>
/**
 * togglePassword()
 * Bascule la visibilité du champ mot de passe et met à jour
 * l'icône Font Awesome (œil ouvert / barré).
 */
function togglePassword() {
    const input = document.getElementById('motDePasse');
    const icon  = document.getElementById('toggleIcon');

    if (input.type === 'password') {
        input.type     = 'text';
        icon.className = 'fas fa-eye-slash'; // œil barré = mot de passe visible
    } else {
        input.type     = 'password';
        icon.className = 'fas fa-eye';       // œil ouvert = mot de passe masqué
    }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\projet laravel\couture-app\resources\views/auth/login.blade.php ENDPATH**/ ?>