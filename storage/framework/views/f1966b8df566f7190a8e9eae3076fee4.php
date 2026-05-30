<?php $__env->startSection('title', 'Collection de Tissus - Couture App'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .tissus-page { padding: 3rem 0 5rem; min-height: 80vh; background-color: var(--gray-100); }

    /* Hero */
    .tissus-hero {
        background: linear-gradient(135deg, var(--dark) 0%, #2d2d4e 100%);
        border-radius: 24px;
        padding: 3rem 2.5rem;
        margin-bottom: 3.5rem;
        text-align: center;
        box-shadow: 0 12px 32px rgba(26,26,46,0.18);
        position: relative;
        overflow: hidden;
    }
    .tissus-hero h1 {
        font-family: 'Playfair Display', serif;
        color: #fff;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    .tissus-hero p {
        color: rgba(255,255,255,0.6);
        max-width: 600px;
        margin: 0 auto;
        font-size: 1.05rem;
    }

    /* Filters Layout */
    .filter-box {
        background: #fff;
        padding: 1.25rem 1.5rem;
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(0,0,0,0.03);
        margin-bottom: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1.25rem;
        border: 1px solid var(--gray-200);
    }

    .filter-groups {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .filter-btn {
        background: var(--gray-100);
        color: var(--gray-700);
        border: 1.5px solid var(--gray-200);
        padding: 0.5rem 1.15rem;
        border-radius: 50px;
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        text-decoration: none;
    }
    .filter-btn:hover, .filter-btn.active {
        background: var(--primary);
        color: #fff;
        border-color: var(--primary);
        transform: translateY(-1px);
    }

    .fav-toggle-btn {
        background: #fff0f1;
        color: #e11d48;
        border: 1.5px solid #fecdd3;
    }
    .fav-toggle-btn:hover, .fav-toggle-btn.active {
        background: #e11d48;
        color: #fff;
        border-color: #e11d48;
    }

    .search-input-group {
        position: relative;
        min-width: 250px;
    }
    .search-input-group i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-500);
    }
    .search-control {
        width: 100%;
        padding: 0.55rem 1rem 0.55rem 2.5rem;
        border-radius: 50px;
        border: 1.5px solid var(--gray-300);
        background: var(--gray-100);
        font-size: 0.85rem;
        transition: all 0.25s;
    }
    .search-control:focus {
        background: #fff;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(201,169,89,0.15);
        outline: none;
    }

    /* Grid */
    .tissus-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
    }

    /* Card */
    .tissu-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid var(--gray-200);
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
    }

    .tissu-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.08);
        border-color: var(--primary);
    }

    .tissu-image-wrapper {
        position: relative;
        padding-top: 100%; /* Aspect ratio 1:1 */
        background: var(--gray-200);
        overflow: hidden;
    }

    .tissu-image {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .tissu-card:hover .tissu-image {
        transform: scale(1.08);
    }

    .tissu-badge-type {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: rgba(26,26,46,0.85);
        color: var(--primary);
        padding: 0.35rem 0.85rem;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        backdrop-filter: blur(4px);
    }

    .tissu-btn-favorite {
        position: absolute;
        top: 1rem;
        right: 1rem;
        width: 38px;
        height: 38px;
        background: #fff;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray-400);
        box-shadow: 0 4px 10px rgba(0,0,0,0.12);
        cursor: pointer;
        transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        z-index: 10;
    }
    .tissu-btn-favorite:hover {
        transform: scale(1.1);
        color: #e11d48;
    }
    .tissu-btn-favorite.active {
        color: #e11d48;
        background: #fff;
    }
    .tissu-btn-favorite i { font-size: 1.1rem; transition: transform 0.2s; }
    .tissu-btn-favorite:active i { transform: scale(1.3); }

    .tissu-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .tissu-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.35rem;
    }

    .tissu-price {
        font-size: 0.9rem;
        color: var(--gray-600);
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .tissu-desc {
        font-size: 0.82rem;
        color: var(--gray-500);
        margin-bottom: 1.25rem;
        line-height: 1.5;
        flex-grow: 1;
    }

    .tissu-btn-book {
        background: var(--dark);
        color: #fff;
        border: 2px solid var(--dark);
        text-align: center;
        padding: 0.6rem 1rem;
        border-radius: 8px;
        font-size: 0.82rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.25s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .tissu-btn-book:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(201,169,89,0.3);
    }

    .tissu-btn-book.disabled {
        background: var(--gray-200);
        border-color: var(--gray-200);
        color: var(--gray-400);
        cursor: not-allowed;
        box-shadow: none;
        pointer-events: none;
    }

    .empty-tissus {
        grid-column: 1 / -1;
        background: #fff;
        border-radius: 20px;
        padding: 5rem 2rem;
        text-align: center;
        border: 2px dashed var(--gray-300);
    }
    .empty-tissus i { font-size: 3rem; color: var(--gray-300); margin-bottom: 1.25rem; }
    .empty-tissus h3 { font-family: 'Playfair Display', serif; color: var(--dark); }

    /* Micro-animation toggle favorite confirmation */
    @keyframes heartPop {
        0% { transform: scale(1); }
        50% { transform: scale(1.4); }
        100% { transform: scale(1); }
    }
    .heart-pop { animation: heartPop 0.45s ease-out; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="tissus-page">
    <div class="container">

        
        <div class="tissus-hero">
            <h1>Découvrez notre collection de Tissus</h1>
            <p>
                Bazin Riche, Wax Hollandais, Coton, Soie... Choisissez la matière d'exception qui donnera vie à vos créations sur-mesure.
            </p>
        </div>

        
        <div class="filter-box">
            <div class="filter-groups">
                <a href="<?php echo e(route('tissus.index')); ?>" class="filter-btn <?php echo e(!request('type') && !request('favorites') ? 'active' : ''); ?>">
                    Tous
                </a>

                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('tissus.index', ['type' => $t])); ?>" class="filter-btn <?php echo e(request('type') === $t ? 'active' : ''); ?>">
                        <?php echo e($t); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if(auth()->guard('client')->check()): ?>
                    <a href="<?php echo e(route('tissus.index', ['favorites' => 1])); ?>" class="filter-btn fav-toggle-btn <?php echo e($onlyFavorites ? 'active' : ''); ?>">
                        <i class="fas fa-heart me-1"></i> Ma Collection
                    </a>
                <?php endif; ?>
            </div>

            <div class="search-input-group">
                <i class="fas fa-search"></i>
                <input type="text" id="tissuSearch" class="search-control" placeholder="Rechercher un tissu...">
            </div>
        </div>

        
        <div class="tissus-grid" id="tissusGrid">
            <?php $__empty_1 = true; $__currentLoopData = $tissus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tissu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="tissu-card" data-nom="<?php echo e(strtolower($tissu->nom)); ?>" data-type="<?php echo e(strtolower($tissu->type)); ?>">
                    
                    
                    <div class="tissu-image-wrapper">
                        <?php if($tissu->image_url): ?>
                            <img src="<?php echo e($tissu->image_url); ?>" alt="<?php echo e($tissu->nom); ?>" class="tissu-image">
                        <?php else: ?>
                            <div class="d-flex align-items-center justify-content-center bg-light text-muted position-absolute w-100 h-100">
                                <i class="fas fa-scissors fa-2x"></i>
                            </div>
                        <?php endif; ?>

                        <span class="tissu-badge-type"><?php echo e($tissu->type); ?></span>

                        
                        <?php if(auth()->guard('client')->check()): ?>
                            <?php
                                $isFav = $tissu->clients->contains(Auth::guard('client')->id());
                            ?>
                            <button 
                                class="tissu-btn-favorite <?php echo e($isFav ? 'active' : ''); ?>" 
                                data-id="<?php echo e($tissu->id); ?>"
                                title="<?php echo e($isFav ? 'Retirer de ma collection' : 'Ajouter à ma collection'); ?>"
                            >
                                <i class="<?php echo e($isFav ? 'fas' : 'far'); ?> fa-heart"></i>
                            </button>
                        <?php else: ?>
                            <button 
                                class="tissu-btn-favorite" 
                                onclick="alert('Veuillez vous connecter pour ajouter des tissus à votre collection de favoris.')"
                                title="Ajouter à ma collection"
                            >
                                <i class="far fa-heart"></i>
                            </button>
                        <?php endif; ?>
                    </div>

                    
                    <div class="tissu-body">
                        <h3 class="tissu-title"><?php echo e($tissu->nom); ?></h3>
                        <div class="tissu-price">
                            <?php if($tissu->prix_metre): ?>
                                <?php echo e(number_format($tissu->prix_metre, 0, ',', ' ')); ?> CFA <span class="fw-normal text-muted" style="font-size:0.75rem;">/ mètre</span>
                            <?php else: ?>
                                <span class="text-muted fw-normal" style="font-size:0.8rem;">Prix sur demande</span>
                            <?php endif; ?>
                        </div>
                        <p class="tissu-desc">
                            <?php echo e($tissu->description ?? 'Aucune description disponible pour ce tissu.'); ?>

                        </p>

                        
                        <?php if($tissu->disponible): ?>
                            <a href="<?php echo e(route('rendezvous.create', ['tissu' => $tissu->id])); ?>" class="tissu-btn-book">
                                <i class="fas fa-calendar-plus"></i> Réserver avec ce tissu
                            </a>
                        <?php else: ?>
                            <button class="tissu-btn-book disabled" disabled>
                                <i class="fas fa-ban"></i> Temporairement indisponible
                            </button>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="empty-tissus">
                    <i class="fas fa-scissors"></i>
                    <h3>Aucun tissu trouvé</h3>
                    <p class="text-muted mt-2">
                        <?php if($onlyFavorites): ?>
                            Vous n'avez pas encore ajouté de tissus à votre collection. Cliquez sur le cœur pour en collectionner !
                        <?php else: ?>
                            Aucun tissu n'est disponible avec ces filtres actuellement.
                        <?php endif; ?>
                    </p>
                    <a href="<?php echo e(route('tissus.index')); ?>" class="btn btn-primary-custom mt-3">
                        Voir tous les tissus
                    </a>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    
    /* Search Filter client-side */
    var searchInput = document.getElementById('tissuSearch');
    var cards       = document.querySelectorAll('.tissu-card');

    if (searchInput) {
        searchInput.addEventListener('input', function (e) {
            var val = e.target.value.toLowerCase().trim();

            cards.forEach(function (card) {
                var nom  = card.getAttribute('data-nom') || '';
                var type = card.getAttribute('data-type') || '';
                if (nom.includes(val) || type.includes(val)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    /* AJAX Favorites Management */
    var favBtns = document.querySelectorAll('.tissu-btn-favorite[data-id]');

    favBtns.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            var tissuId = this.getAttribute('data-id');
            var heart   = this.querySelector('i');
            var self    = this;

            // Bloquer le clic répétitif pendant la requête
            self.style.pointerEvents = 'none';

            fetch('/tissus/' + tissuId + '/favorite', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(async function (response) {
                var data = await response.json();
                self.style.pointerEvents = '';

                if (response.ok && data.success) {
                    // Animation
                    self.classList.add('heart-pop');
                    setTimeout(function() {
                        self.classList.remove('heart-pop');
                    }, 450);

                    if (data.is_favorite) {
                        self.classList.add('active');
                        heart.className = 'fas fa-heart';
                        self.setAttribute('title', 'Retirer de ma collection');
                    } else {
                        self.classList.remove('active');
                        heart.className = 'far fa-heart';
                        self.setAttribute('title', 'Ajouter à ma collection');

                        // Si on est sur l'onglet "Ma Collection" uniquement, on cache le tissu retiré
                        <?php if($onlyFavorites): ?>
                            var card = self.closest('.tissu-card');
                            if (card) {
                                card.style.opacity = '0';
                                setTimeout(function () {
                                    card.remove();
                                    // S'il n'y a plus de cartes, recharger pour afficher le empty state
                                    if (document.querySelectorAll('.tissu-card').length === 0) {
                                        window.location.reload();
                                    }
                                }, 300);
                            }
                        <?php endif; ?>
                    }
                } else {
                    alert(data.message || 'Une erreur est survenue.');
                }
            })
            .catch(function () {
                self.style.pointerEvents = '';
                alert('Erreur réseau. Impossible de modifier les favoris.');
            });
        });
    });

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\projet laravel\couture-app\resources\views/tissus/index.blade.php ENDPATH**/ ?>