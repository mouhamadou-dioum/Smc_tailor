<?php $__env->startSection('title', 'Réserver un Rendez-vous - Couture App'); ?>



<?php $__env->startSection('styles'); ?>
<style>
    /*
     * En-tête de page — identique au style hero des autres pages
     * (rendezvous/index, vetements/index…)
     */
    .page-header {
        background: linear-gradient(135deg, var(--dark) 0%, #2d2d4a 100%);
        padding: 3.5rem 0 2.5rem;
        margin-bottom: 0;
    }

    .page-header .section-title {
        color: var(--white);
        font-family: 'Playfair Display', serif;
        font-size: 2.25rem;
    }

    .page-header .section-subtitle {
        color: var(--gray-400);
        font-size: 1rem;
        margin-bottom: 0;
    }

    .page-header .section-subtitle a {
        color: var(--primary);
        text-decoration: none;
    }

    .page-header .section-subtitle a:hover {
        text-decoration: underline;
    }

    /* Zone principale du formulaire */
    .rdv-form-section {
        padding: 3rem 0 4rem;
        background: var(--gray-100);
        min-height: calc(100vh - 280px);
    }

    /* Carte vêtement pré-sélectionné */
    .vetement-preselect-card {
        background: var(--gray-100);
        border: 1.5px solid var(--gray-300) !important;
        border-radius: 10px;
    }

    /* Options radio de notification */
    .notif-option {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1.25rem;
        border: 2px solid var(--gray-300);
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        font-weight: 500;
        color: var(--gray-700);
        user-select: none;
    }

    .notif-option:hover {
        border-color: var(--primary);
        color: var(--primary);
    }

    /* Encart info bleu */
    .info-box {
        background-color: #e8f4fd;
        border-left: 4px solid #3b9ede;
        border-radius: 0 8px 8px 0;
        padding: 0.85rem 1.1rem;
        color: #0c5460;
        font-size: 0.9rem;
    }
</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title">Réserver un rendez-vous</h2>
            <p class="section-subtitle mt-3">
                <?php if($vetementPreselect): ?>
                    Vous réservez pour le modèle sélectionné dans la collection.
                <?php else: ?>
                    Rendez-vous général (prise de mesures, conseil, autre demande).<br>
                    Pour un modèle précis, passez par la
                    <a href="<?php echo e(route('vetements.index')); ?>">collection</a> puis « Réserver ».
                <?php endif; ?>
            </p>
        </div>
    </div>
</div>


<section class="rdv-form-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">

                
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger mb-4 rounded-3">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Veuillez corriger les erreurs ci-dessous.
                    </div>
                <?php endif; ?>

                <div class="form-custom">
                    <form id="rendezvousForm" method="POST" action="<?php echo e(route('rendezvous.store')); ?>">
                        <?php echo csrf_field(); ?>

                        
                        <?php if($vetementPreselect): ?>
                            <input type="hidden" name="vetement_id" value="<?php echo e($vetementPreselect->id); ?>">
                            <div class="vetement-preselect-card mb-4 p-3">
                                <div class="d-flex gap-3 align-items-center flex-wrap flex-sm-nowrap">
                                    <?php
                                        $_src = $vetementPreselect->imageUrl;
                                        $_src = $_src && !str_starts_with($_src, 'http') ? \Illuminate\Support\Facades\Storage::url($_src) : $_src;
                                    ?>
                                    <?php if($_src): ?>
                                        <img
                                            src="<?php echo e($_src); ?>"
                                            alt="<?php echo e($vetementPreselect->nom); ?>"
                                            class="rounded"
                                            style="width:72px;height:72px;min-width:72px;object-fit:cover;"
                                        >
                                    <?php endif; ?>
                                    <div class="flex-grow-1">
                                        <label class="form-label-custom mb-1" style="font-size:0.8rem;text-transform:uppercase;letter-spacing:.5px;color:var(--gray-500);">Modèle concerné</label>
                                        <div class="fw-bold" style="color:var(--dark);"><?php echo e($vetementPreselect->nom); ?></div>
                                        <span class="text-muted" style="font-size:0.875rem;"><?php echo e(number_format($vetementPreselect->prix, 0, ',', ' ')); ?> CFA</span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        
                        <?php if(auth()->guard('client')->guest()): ?>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-custom" for="prenomInput">
                                        <i class="fas fa-user me-1 text-muted"></i> Prénom *
                                    </label>
                                    <input
                                        type="text"
                                        name="prenom"
                                        id="prenomInput"
                                        class="form-control form-control-custom <?php $__errorArgs = ['prenom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        required
                                        value="<?php echo e(old('prenom')); ?>"
                                    >
                                    <?php $__errorArgs = ['prenom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger small"><i class="fas fa-exclamation-circle me-1"></i><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label-custom" for="nomInput">
                                        <i class="fas fa-user me-1 text-muted"></i> Nom *
                                    </label>
                                    <input
                                        type="text"
                                        name="nom"
                                        id="nomInput"
                                        class="form-control form-control-custom <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        required
                                        value="<?php echo e(old('nom')); ?>"
                                    >
                                    <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger small"><i class="fas fa-exclamation-circle me-1"></i><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label-custom" for="telephoneInput">
                                        <i class="fas fa-phone me-1 text-muted"></i> Téléphone *
                                    </label>
                                    <input
                                        type="text"
                                        name="telephone"
                                        id="telephoneInput"
                                        class="form-control form-control-custom <?php $__errorArgs = ['telephone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        required
                                        value="<?php echo e(old('telephone')); ?>"
                                        placeholder="Ex : +221 77 123 45 67"
                                        pattern="^(?:(?:\+|00)221)?[ -]?7[15678][ -]?\d{3}[ -]?\d{2}[ -]?\d{2}$"
                                        title="Numéro sénégalais valide : 77 123 45 67, +221 77 123 45 67"
                                    >
                                    <?php $__errorArgs = ['telephone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger small"><i class="fas fa-exclamation-circle me-1"></i><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label-custom" for="emailInput">
                                        <i class="fas fa-envelope me-1 text-muted"></i> Adresse Email <span class="text-muted fw-normal">(optionnel)</span>
                                    </label>
                                    <input
                                        type="email"
                                        name="email"
                                        id="emailInput"
                                        class="form-control form-control-custom <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('email')); ?>"
                                        placeholder="Ex : client@email.com"
                                    >
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger small"><i class="fas fa-exclamation-circle me-1"></i><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label-custom" for="dateInput">
                                    <i class="fas fa-calendar me-1 text-muted"></i> Date du rendez-vous *
                                </label>
                                <input
                                    type="date"
                                    name="dateRendezVous"
                                    id="dateInput"
                                    class="form-control form-control-custom <?php $__errorArgs = ['dateRendezVous'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    required
                                    min="<?php echo e(date('Y-m-d', strtotime('+1 day'))); ?>"
                                    value="<?php echo e(old('dateRendezVous')); ?>"
                                >
                                <?php $__errorArgs = ['dateRendezVous'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger small"><i class="fas fa-exclamation-circle me-1"></i><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label-custom" for="heureSelect">
                                    <i class="fas fa-clock me-1 text-muted"></i> Heure *
                                </label>
                                <select
                                    name="heure"
                                    id="heureSelect"
                                    class="form-select form-control-custom <?php $__errorArgs = ['heure'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    required
                                >
                                    <option value="">Sélectionnez l'heure</option>
                                    <?php $__currentLoopData = ['09:00','10:00','11:00','14:00','15:00','16:00','17:00']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($h); ?>" <?php echo e(old('heure') === $h ? 'selected' : ''); ?>><?php echo e($h); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['heure'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger small"><i class="fas fa-exclamation-circle me-1"></i><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        
                        <div class="mb-4">
                            <label class="form-label-custom" for="commentaire">
                                <i class="fas fa-comment me-1 text-muted"></i>
                                <?php if($vetementPreselect): ?>
                                    Commentaire <span class="text-muted fw-normal">(optionnel)</span>
                                <?php else: ?>
                                    Décrivez votre demande *
                                <?php endif; ?>
                            </label>
                            <textarea
                                name="commentaire"
                                id="commentaire"
                                class="form-control form-control-custom <?php $__errorArgs = ['commentaire'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                rows="4"
                                placeholder="<?php echo e($vetementPreselect ? 'Précisez vos attentes, mensurations particulières…' : 'Ex. : prise de mesures pour costume, retouches, consultation style…'); ?>"
                                <?php echo e($vetementPreselect ? '' : 'required'); ?>

                            ><?php echo e(old('commentaire')); ?></textarea>
                            <?php $__errorArgs = ['commentaire'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger small"><i class="fas fa-exclamation-circle me-1"></i><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <?php if(!$vetementPreselect): ?>
                                <small class="text-muted mt-1 d-block">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Sans modèle lié, merci d'indiquer clairement l'objet du rendez-vous.
                                </small>
                            <?php endif; ?>
                        </div>

                        <input type="hidden" name="typeNotification" value="WHATSAPP">

                        
                        <div class="info-box mb-4">
                            <i class="fas fa-info-circle me-2"></i>
                            Votre demande sera traitée par l'administrateur.
                            Vous recevrez une confirmation par WhatsApp.
                        </div>

                        
                        <button type="submit" class="btn btn-primary-custom w-100" id="submitBtn">
                            <i class="fas fa-paper-plane me-2"></i> Soumettre la demande
                        </button>

                    </form>
                </div><!-- /.form-custom -->

            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
/**
 * Met en surbrillance la carte de notification sélectionnée.
 * @param {HTMLInputElement} radio - le radio button cliqué
 */
function updateNotifStyle(radio) {
    // Réinitialise toutes les cartes de notification
    document.querySelectorAll('.notif-option').forEach(function(el) {
        el.style.borderColor = '';
        el.style.background  = '';
        el.style.color       = '';
    });
    // Surligne la carte du choix courant avec la couleur primaire
    var label = radio.closest('.notif-option');
    if (label) {
        label.style.borderColor = 'var(--primary)';
        label.style.background  = 'rgba(201,169,89,0.07)';
        label.style.color       = 'var(--primary)';
    }
}

document.addEventListener('DOMContentLoaded', function () {

    /* ── Date minimum = demain ── */
    var dateInput = document.getElementById('dateInput');
    var tomorrow  = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    dateInput.min = tomorrow.toISOString().split('T')[0];

    /* ── Initialise le style de la notification cochée par défaut ── */
    var checkedRadio = document.querySelector('input[name="typeNotification"]:checked');
    if (checkedRadio) updateNotifStyle(checkedRadio);

    /* ── Soumission AJAX ── */
    var form      = document.getElementById('rendezvousForm');
    var submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Feedback visuel pendant l'envoi
        submitBtn.disabled  = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Envoi en cours…';

        var formData = new FormData(this);

        fetch(this.action, {
            method:  'POST',
            body:    formData,
            headers: {
                'X-CSRF-TOKEN':     document.querySelector('input[name="_token"]').value,
                'Accept':           'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(async function (response) {
            var data = await response.json().catch(function () { return {}; });

            if (response.ok && data.success) {
                // Succès : on redirige dynamiquement selon la réponse (accueil ou liste des RDV)
                alert(data.message || 'Votre demande de rendez-vous a été soumise avec succès !');
                window.location.href = data.redirect || '<?php echo e(route("home")); ?>';
                return;
            }

            if (response.status === 422 && data.errors) {
                // Erreur de validation Laravel : affiche la première erreur
                var first = Object.values(data.errors).flat()[0];
                alert(first || 'Veuillez corriger le formulaire.');
            } else {
                alert(data.message || 'Une erreur est survenue. Veuillez réessayer.');
            }

            // Réactive le bouton en cas d'erreur pour permettre une nouvelle tentative
            submitBtn.disabled  = false;
            submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i> Soumettre la demande';
        })
        .catch(function () {
            alert('Une erreur réseau est survenue. Veuillez réessayer.');
            submitBtn.disabled  = false;
            submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i> Soumettre la demande';
        });
    });

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\projet laravel\couture-app\resources\views/rendezvous/create.blade.php ENDPATH**/ ?>