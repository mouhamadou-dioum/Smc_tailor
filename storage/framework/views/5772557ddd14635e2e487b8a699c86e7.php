<?php $__env->startSection('title', 'Historique des mesures - ' . ($client->nom ?? 'Client')); ?>

<?php $__env->startSection('styles'); ?>
<style>
    /* ── Page ── */
    .histo-page {
        padding: 2.5rem 0 5rem;
        min-height: calc(100vh - 200px);
        background: var(--gray-100);
    }

    /* ── Hero Header ── */
    .histo-hero {
        background: linear-gradient(135deg, var(--dark) 0%, #252545 60%, #1f3a52 100%);
        border-radius: 24px;
        padding: 2rem 2.5rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        box-shadow: 0 12px 40px rgba(26,26,46,0.22);
        position: relative;
        overflow: hidden;
    }

    .histo-hero::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -5%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(201,169,89,0.18) 0%, transparent 70%);
        pointer-events: none;
    }

    .histo-hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .histo-hero-title i { color: var(--primary); }

    .histo-hero-sub {
        color: rgba(255,255,255,0.5);
        font-size: 0.875rem;
        margin: 0;
    }

    .btn-back {
        border: 1.5px solid rgba(255,255,255,0.3);
        color: #fff;
        background: rgba(255,255,255,0.07);
        padding: 0.55rem 1.25rem;
        border-radius: 10px;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.25s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        white-space: nowrap;
    }

    .btn-back:hover {
        background: rgba(255,255,255,0.15);
        color: #fff;
        transform: translateX(-3px);
    }

    /* ── Client Card ── */
    .client-card {
        background: #fff;
        border-radius: 18px;
        border: 1.5px solid var(--gray-200);
        box-shadow: 0 2px 16px rgba(0,0,0,0.06);
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.75rem;
        display: flex;
        align-items: center;
        gap: 1.25rem;
    }

    .client-avatar {
        width: 54px;
        height: 54px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(201,169,89,0.35);
    }

    .client-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0 0 0.2rem;
    }

    .client-meta {
        font-size: 0.8rem;
        color: var(--gray-600);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    .client-count {
        margin-left: auto;
        background: var(--gray-100);
        border: 1.5px solid var(--gray-200);
        border-radius: 12px;
        padding: 0.5rem 1rem;
        text-align: center;
        font-size: 0.8rem;
        color: var(--gray-600);
        flex-shrink: 0;
    }

    .client-count strong {
        display: block;
        font-size: 1.4rem;
        font-family: 'Playfair Display', serif;
        color: var(--primary);
        line-height: 1;
        margin-bottom: 0.15rem;
    }

    /* ── Empty State ── */
    .empty-histo {
        background: #fff;
        border-radius: 18px;
        border: 1.5px dashed var(--gray-300);
        padding: 4rem 2rem;
        text-align: center;
        color: var(--gray-500);
    }

    .empty-histo i {
        font-size: 3rem;
        opacity: 0.25;
        display: block;
        margin-bottom: 1rem;
        color: var(--dark);
    }

    .empty-histo h5 {
        font-family: 'Playfair Display', serif;
        color: var(--dark);
        margin-bottom: 0.4rem;
    }

    /* ── Mesure Cards Grid ── */
    .mesures-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.25rem;
    }

    .mesure-card {
        background: #fff;
        border-radius: 18px;
        border: 1.5px solid var(--gray-200);
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .mesure-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 28px rgba(0,0,0,0.1);
        border-color: var(--primary);
    }

    /* Card top band with date */
    .mesure-card-header {
        background: linear-gradient(135deg, var(--dark), #2d2d4e);
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .mesure-date {
        display: flex;
        align-items: baseline;
        gap: 0.35rem;
    }

    .mesure-date .day {
        font-family: 'Playfair Display', serif;
        font-size: 1.9rem;
        font-weight: 700;
        color: var(--primary);
        line-height: 1;
    }

    .mesure-date .month {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(255,255,255,0.6);
    }

    .mesure-label {
        font-family: 'Playfair Display', serif;
        font-size: 0.95rem;
        font-weight: 600;
        color: #fff;
        max-width: 55%;
        text-align: right;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Card body with measurements */
    .mesure-card-body {
        padding: 1.1rem 1.25rem;
    }

    .mesure-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.6rem;
    }

    .mesure-item {
        background: var(--gray-100);
        border-radius: 10px;
        padding: 0.5rem 0.6rem;
        text-align: center;
        border: 1px solid var(--gray-200);
    }

    .mesure-item-label {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-500);
        margin-bottom: 0.15rem;
        font-weight: 600;
    }

    .mesure-item-value {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--dark);
        font-family: 'Playfair Display', serif;
    }

    .mesure-item-value.empty {
        color: var(--gray-400);
        font-size: 0.8rem;
        font-weight: 400;
        font-family: 'Lato', sans-serif;
    }

    /* Card footer */
    .mesure-card-footer {
        padding: 0.65rem 1.25rem;
        border-top: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.4rem;
        background: var(--gray-100);
    }

    .time-pill {
        font-size: 0.72rem;
        color: var(--gray-500);
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    @media (max-width: 576px) {
        .histo-hero { padding: 1.25rem; border-radius: 16px; }
        .histo-hero-title { font-size: 1.35rem; }
        .mesures-grid { grid-template-columns: 1fr; }
        .client-count { display: none; }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $initials = strtoupper(
        substr($client->prenom ?? 'C', 0, 1) .
        substr($client->nom    ?? '', 0, 1)
    );

    $fields = [
        'cou'      => 'Cou',
        'epaule'   => 'Épaule',
        'manche'   => 'Manche',
        'poitrine' => 'Poitrine',
        'taille'   => 'Taille',
        'hanche'   => 'Hanche',
        'tourbras' => 'Bras',
        'cuisse'   => 'Cuisse',
        'longueur' => 'Longueur',
    ];
?>

<div class="histo-page">
    <div class="container">

        
        <div class="histo-hero">
            <div>
                <h1 class="histo-hero-title">
                    <i class="fas fa-ruler-combined"></i>
                    Historique des mesures
                </h1>
                <p class="histo-hero-sub">Toutes les mensurations enregistrées pour ce client</p>
            </div>
            <a href="<?php echo e(route('admin.clients.index')); ?>" class="btn-back">
                <i class="fas fa-arrow-left"></i> Retour aux clients
            </a>
        </div>

        
        <div class="client-card">
            <div class="client-avatar"><?php echo e($initials); ?></div>
            <div class="flex-grow-1">
                <p class="client-name"><?php echo e($client->prenom); ?> <?php echo e($client->nom); ?></p>
                <p class="client-meta">
                    <i class="fas fa-phone fa-xs"></i> <?php echo e($client->telephone ?? 'Non renseigné'); ?>

                </p>
                <p class="client-meta mt-1">
                    <i class="fas fa-envelope fa-xs"></i> <?php echo e($client->email); ?>

                </p>
            </div>
            <div class="client-count">
                <strong><?php echo e($mesures->count()); ?></strong>
                mesure<?php echo e($mesures->count() > 1 ? 's' : ''); ?>

            </div>
        </div>

        
        <?php if($mesures->isEmpty()): ?>
            <div class="empty-histo">
                <i class="fas fa-ruler-combined"></i>
                <h5>Aucune mesure enregistrée</h5>
                <p class="mb-0">Les mesures de ce client apparaîtront ici une fois saisies.</p>
            </div>

        <?php else: ?>
            
            <div class="mesures-grid">
                <?php $__currentLoopData = $mesures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mesure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mesure-card">

                    <div class="mesure-card-header">
                        <div class="mesure-date">
                            <span class="day"><?php echo e($mesure->created_at->format('d')); ?></span>
                            <span class="month"><?php echo e($mesure->created_at->translatedFormat('M Y')); ?></span>
                        </div>
                        <div class="mesure-label" title="<?php echo e($mesure->modele ?? ''); ?>">
                            <?php echo e($mesure->nom ?? 'Tenue sans nom'); ?>

                            <?php if($mesure->modele): ?>
                                <br><small style="font-size:0.75rem;opacity:0.7;"><?php echo e($mesure->modele); ?></small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mesure-card-body">
                        <div class="mesure-grid">
                            <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="mesure-item">
                                <div class="mesure-item-label"><?php echo e($label); ?></div>
                                <?php if(!empty($mesure->$key)): ?>
                                    <div class="mesure-item-value"><?php echo e($mesure->$key); ?><span style="font-size:0.6rem;font-weight:400;color:var(--gray-500);margin-left:1px;">cm</span></div>
                                <?php else: ?>
                                    <div class="mesure-item-value empty">—</div>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <?php if($mesure->photo_tissu || $mesure->photo_modele): ?>
                        <div class="row mt-3 g-2">
                            <?php if($mesure->photo_tissu): ?>
                            <div class="col-6">
                                <div class="mesure-item-label mb-1">Tissu</div>
                                <a href="<?php echo e(asset('storage/' . $mesure->photo_tissu)); ?>" target="_blank">
                                    <img src="<?php echo e(asset('storage/' . $mesure->photo_tissu)); ?>" 
                                         alt="Photo tissu" 
                                         style="width:100%;height:80px;object-fit:cover;border-radius:8px;border:1px solid var(--gray-200);">
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if($mesure->photo_modele): ?>
                            <div class="col-6">
                                <div class="mesure-item-label mb-1">Modèle</div>
                                <a href="<?php echo e(asset('storage/' . $mesure->photo_modele)); ?>" target="_blank">
                                    <img src="<?php echo e(asset('storage/' . $mesure->photo_modele)); ?>" 
                                         alt="Photo modèle" 
                                         style="width:100%;height:80px;object-fit:cover;border-radius:8px;border:1px solid var(--gray-200);">
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="mesure-card-footer">
                        <span class="time-pill">
                            <i class="fas fa-clock fa-xs"></i>
                            <?php echo e($mesure->created_at->diffForHumans()); ?>

                        </span>
                    </div>

                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\projet laravel\couture-app\resources\views/admin/mesures/historique.blade.php ENDPATH**/ ?>