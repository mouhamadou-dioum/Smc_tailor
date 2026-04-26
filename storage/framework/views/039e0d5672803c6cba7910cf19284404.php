<?php $__env->startSection('title', 'Réserver un Rendez-vous - Couture App'); ?>

<?php $__env->startSection('content'); ?>
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Réserver un rendez-vous</h2>
            <?php if($vetementPreselect): ?>
                <p class="section-subtitle mb-0">Vous réservez pour le modèle sélectionné dans la collection.</p>
            <?php else: ?>
                <p class="section-subtitle mb-0">Rendez-vous général (prise de mesures, conseil, autre demande). Pour un modèle précis, passez par la <a href="<?php echo e(route('vetements.index')); ?>">collection</a> puis « Réserver ».</p>
            <?php endif; ?>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-custom">
                    <form id="rendezvousForm" method="POST" action="<?php echo e(route('rendezvous.store')); ?>">
                        <?php echo csrf_field(); ?>

                        <?php if($vetementPreselect): ?>
                            <input type="hidden" name="vetement_id" value="<?php echo e($vetementPreselect->id); ?>">
                            <div class="mb-4 p-3 rounded border" style="border-color: var(--gray-300) !important; background: var(--gray-100);">
                                <div class="d-flex gap-3 align-items-center flex-wrap flex-sm-nowrap">
                                    <?php if($vetementPreselect->imageUrl): ?>
                                        <img src="<?php echo e($vetementPreselect->imageUrl); ?>" alt="" class="rounded" style="width: 72px; height: 72px; min-width: 72px; object-fit: cover;">
                                    <?php endif; ?>
                                    <div class="flex-grow-1">
                                        <div class="form-label-custom mb-1">Modèle concerné</div>
                                        <strong><?php echo e($vetementPreselect->nom); ?></strong>
                                        <span class="text-muted ms-2"><?php echo e(number_format($vetementPreselect->prix, 0, ',', ' ')); ?> CFA</span>
                                    </div>
                                    <a href="<?php echo e(route('vetements.index')); ?>" class="btn btn-outline-custom btn-sm">Changer de modèle</a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label-custom">Date du rendez-vous *</label>
                                <input type="date" name="dateRendezVous" id="dateInput" class="form-control form-control-custom" required min="<?php echo e(date('Y-m-d', strtotime('+1 day'))); ?>" value="<?php echo e(old('dateRendezVous')); ?>">
                                <?php $__errorArgs = ['dateRendezVous'];
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
                            <div class="col-md-6 mb-4">
                                <label class="form-label-custom">Heure *</label>
                                <select name="heure" class="form-select form-control-custom" required>
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
                                    <span class="text-danger small"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label-custom">
                                <?php if($vetementPreselect): ?>
                                    Commentaire (optionnel)
                                <?php else: ?>
                                    Décrivez votre demande *
                                <?php endif; ?>
                            </label>
                            <textarea name="commentaire" class="form-control form-control-custom" rows="4" placeholder="<?php echo e($vetementPreselect ? 'Précisez vos attentes...' : 'Ex. : prise de mesures pour costume, retouches, consultation style…'); ?>" <?php echo e($vetementPreselect ? '' : 'required'); ?>><?php echo e(old('commentaire')); ?></textarea>
                            <?php $__errorArgs = ['commentaire'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger small"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <?php if(!$vetementPreselect): ?>
                                <small class="text-muted">Sans modèle lié, merci d’indiquer clairement l’objet du rendez-vous.</small>
                            <?php endif; ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label-custom">Type de notification préférée *</label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="typeNotification" id="notifEmail" value="EMAIL" <?php echo e(old('typeNotification', 'EMAIL') === 'EMAIL' ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="notifEmail">
                                        <i class="fas fa-envelope me-1"></i> Email
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="typeNotification" id="notifWhatsapp" value="WHATSAPP" <?php echo e(old('typeNotification') === 'WHATSAPP' ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="notifWhatsapp">
                                        <i class="fab fa-whatsapp me-1"></i> WhatsApp
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-custom mb-4" style="background-color: #e7f3ff; color: #0c5460;">
                            <i class="fas fa-info-circle me-2"></i>
                            Votre demande sera traitée par l’administrateur. Vous recevrez une confirmation par le canal choisi.
                        </div>

                        <button type="submit" class="btn btn-primary-custom w-100">
                            <i class="fas fa-paper-plane me-2"></i> Soumettre la demande
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('dateInput');
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    dateInput.min = tomorrow.toISOString().split('T')[0];

    const form = document.getElementById('rendezvousForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(async response => {
            const data = await response.json().catch(() => ({}));
            if (response.ok && data.success) {
                alert(data.message || 'Votre demande de rendez-vous a été soumise avec succès!');
                window.location.href = '<?php echo e(route("rendezvous.index")); ?>';
                return;
            }
            if (response.status === 422 && data.errors) {
                const first = Object.values(data.errors).flat()[0];
                alert(first || 'Veuillez corriger le formulaire.');
                return;
            }
            alert(data.message || 'Une erreur est survenue. Veuillez réessayer.');
        })
        .catch(() => {
            alert('Une erreur est survenue. Veuillez réessayer.');
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\Desktop\projet laravel\couture-app\resources\views/rendezvous/create.blade.php ENDPATH**/ ?>