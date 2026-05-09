<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Couture App'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Lato:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #c9a959;
            --primary-dark: #a88942;
            --secondary: #2c3e50;
            --dark: #1a1a2e;
            --light: #f8f9fa;
            --white: #ffffff;
            --gray-100: #f5f5f5;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-400: #ced4da;
            --gray-500: #adb5bd;
            --gray-600: #6c757d;
            --gray-700: #495057;
            --gray-800: #343a40;
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.08);
            --shadow: 0 4px 12px rgba(0,0,0,0.1);
            --shadow-lg: 0 8px 24px rgba(0,0,0,0.12);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Lato', sans-serif;
            background-color: var(--gray-100);
            color: var(--gray-800);
            line-height: 1.6;
        }
        /* DASHBOARD + LIST STYLE GLOBAL */
.rdv-card {
    background: white;
    padding: 1rem;
    border-radius: 16px;
    transition: 0.3s;
    border: 1px solid #eee;
}

.rdv-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.stat-card {
    text-align: center;
    padding: 1.5rem;
}

.stat-card i {
    font-size: 1.5rem;
    background: #eef2ff;
    padding: 10px;
    border-radius: 10px;
    margin-bottom: 10px;
}

.list-card {
    margin-bottom: 10px;
}

/* STATUS */
.statut-confirme { border-left: 4px solid #10b981; }
.statut-attente { border-left: 4px solid #f59e0b; }
.statut-refuse { border-left: 4px solid #ef4444; }

.status-pill {
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 500;
}

.confirme { background: #d1fae5; color: #065f46; }
.attente { background: #fef3c7; color: #92400e; }
.refuse { background: #fee2e2; color: #991b1b; }

/* BUTTON ACTION */
.btn-action {
    background: #6366f1;
    color: white;
    padding: 6px 10px;
    border-radius: 8px;
}

.rdv-page {
    padding: 2rem 0;
    min-height: calc(100vh - 200px);
}

/* ── Navbar ── */
.navbar-custom {
    background-color: var(--white);
    box-shadow: var(--shadow-sm);
    padding: 1rem 0;
    position: sticky;
    top: 0;
    z-index: 1000;
    overflow: visible;
}

.navbar-custom .container {
    flex-wrap: wrap;
}

.navbar-brand {
    font-family: 'Playfair Display', serif;
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--primary) !important;
    letter-spacing: 1px;
    text-decoration: none;
}

.navbar-toggler-custom {
    display: none;
    background: none;
    border: none;
    font-size: 1.5rem;
    color: var(--primary);
    cursor: pointer;
    padding: 0.4rem 0.6rem;
    line-height: 1;
}

.nav-actions {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    row-gap: 0.5rem;
}

.nav-link-custom {
    color: var(--gray-700) !important;
    font-weight: 500;
    padding: 0.5rem 1rem !important;
    transition: all 0.3s ease;
    text-decoration: none;
}

.nav-link-custom:hover { color: var(--primary) !important; }

.nav-link-with-icon {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    text-decoration: none;
}

.nav-link-with-icon i { opacity: 0.92; }

/* ── Footer ── */
.footer-custom {
    background-color: var(--dark);
    color: var(--gray-400);
    padding: 4rem 0 2rem;
}

.footer-title {
    color: var(--primary);
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
}

.rdv-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(201,169,89,0.3);
}

.rdv-header h2 {
    font-family: 'Playfair Display', serif;
    color: var(--dark);
    font-size: 1.75rem;
    margin-bottom: 0.25rem;
}

.subtitle {
    color: var(--gray-600);
    font-size: 0.95rem;
}

.rdv-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1rem;
}

.rdv-info {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.rdv-client, .rdv-vetement {
    font-weight: 600;
    color: var(--dark);
    font-size: 1rem;
}

.rdv-phone, .rdv-comment {
    color: var(--gray-600);
    font-size: 0.875rem;
}

.rdv-date-block {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 60px;
}

.alert-info-custom {
    background-color: #d1ecf1;
    color: #0c5460;
}

.empty-state {
    text-align: center;
    padding: 3rem;
    color: var(--gray-600);
}

.empty-state i {
    font-size: 3rem;
    opacity: 0.3;
    margin-bottom: 1rem;
}

.btn-action.view {
    background: var(--primary);
    color: white;
}

.btn-action.reject {
    background: #ef4444;
    color: white;
}

.rdv-actions {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

/* ── Hero Section ── */
.hero-section {
    background: linear-gradient(135deg, var(--dark) 0%, #2d2d4a 100%);
    padding: 6rem 0;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 60%;
    height: 200%;
    background: radial-gradient(circle, rgba(201,169,89,0.15) 0%, transparent 70%);
    animation: float 8s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(5deg); }
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    color: var(--white);
    line-height: 1.2;
    margin-bottom: 1.5rem;
}

.hero-subtitle {
    font-size: 1.25rem;
    color: var(--gray-300);
    margin-bottom: 2rem;
}

/* ── Sections ── */
.section-title {
    font-size: 2.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
    position: relative;
    display: inline-block;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 60px;
    height: 3px;
    background-color: var(--primary);
}

.section-subtitle {
    color: var(--gray-600);
    font-size: 1.1rem;
    margin-bottom: 3rem;
}

/* ── Cards ── */
.card-custom {
    background-color: var(--white);
    border: none;
    border-radius: 12px;
    box-shadow: var(--shadow);
    transition: all 0.3s ease;
    overflow: hidden;
}

.card-custom:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

/* ── Footer Link ── */
.footer-link {
    color: var(--gray-400);
    text-decoration: none;
    transition: all 0.3s ease;
}

.footer-link:hover {
    color: var(--primary);
    padding-left: 5px;
}

/* ── Social Icon ── */
.social-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: rgba(255,255,255,0.1);
    color: var(--gray-300);
    margin-right: 0.5rem;
    transition: all 0.3s ease;
    text-decoration: none;
}

.social-icon:hover {
    background-color: var(--primary);
    color: var(--white);
    transform: translateY(-3px);
}

.badge-waiting   { background-color: #fff3cd; color: #856404; padding: 0.35rem 0.75rem; border-radius: 20px; font-weight: 600; font-size: 0.75rem; }
.badge-confirmed { background-color: #d4edda; color: #155724; padding: 0.35rem 0.75rem; border-radius: 20px; font-weight: 600; font-size: 0.75rem; }
.badge-rejected  { background-color: #f8d7da; color: #721c24; padding: 0.35rem 0.75rem; border-radius: 20px; font-weight: 600; font-size: 0.75rem; }

        /* ════════════════════════════════════════
           RESPONSIVE — Tablet (≤991px)
           ✅ Menu visible mais en colonne
        ════════════════════════════════════════ */
        @media (max-width: 991px) {
            .navbar-toggler-custom { display: block; }

            .navbar-custom {
                padding: 0.5rem 0;
            }

            .navbar-custom .container,
            .navbar-custom .navbar-wrapper {
                flex-wrap: wrap;
                align-items: center;
            }

            .navbar-brand { font-size: 1.3rem; }

            .nav-actions {
                display: flex;
                position: static;
                width: 100%;
                flex-direction: row;
                align-items: center;
                flex-wrap: wrap;
                background: transparent;
                border: none;
                box-shadow: none;
                padding: 0.5rem 0;
                gap: 0.5rem;
            }

            .nav-actions.active {
                display: flex;
            }

            .nav-link-custom {
                padding: 0.5rem 0.75rem !important;
                font-size: 0.85rem;
            }

            .nav-link-custom::after { display: none; }

            .nav-actions form {
                padding: 0;
            }

            .nav-actions form .btn,
            .nav-actions > a.btn {
                font-size: 0.8rem;
                padding: 0.3rem 0.75rem;
            }

            .hero-section { padding: 3rem 0; }
        }

        /* ── Mobile (≤768px) ── */
        @media (max-width: 768px) {
            .hero-title    { font-size: 2rem; }
            .hero-subtitle { font-size: 1rem; }
            .section-title { font-size: 1.75rem; }
            .section-subtitle { font-size: 1rem; margin-bottom: 2rem; }

            .navbar-custom  { padding: 0.4rem 0; }
            .navbar-brand   { font-size: 1.3rem; }

            .form-custom    { padding: 1.5rem; }
            .footer-custom  { padding: 2.5rem 0 1.5rem; }
            .footer-title   { font-size: 1.25rem; }

            .featured-card img { height: 300px; }
            .card-custom { padding: 1rem; }
        }

        /* ── Small mobile (≤576px) ── */
        @media (max-width: 576px) {
            .hero-title    { font-size: 1.6rem; }
            .hero-subtitle { font-size: 0.95rem; }
            .section-title { font-size: 1.4rem; }

            h2 { font-size: 1.4rem; }
            h3 { font-size: 1.2rem; }

            .btn      { padding: 0.5rem 1rem; font-size: 0.875rem; }
            .btn-sm   { padding: 0.375rem 0.75rem; font-size: 0.8rem; }

            .form-custom         { padding: 1.25rem; }
            .form-control-custom { padding: 0.625rem 0.875rem; font-size: 0.9rem; }

            .featured-card img { height: 220px; }
            .footer-custom .col-md-4 { margin-bottom: 1.5rem; }
        }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <nav class="navbar-custom">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap w-100 navbar-wrapper">
                <a class="navbar-brand" href="<?php echo e(route('home')); ?>">COUTURE</a>

                <button class="navbar-toggler-custom" id="navToggler" aria-label="Menu">
                    <i class="fas fa-bars" id="navIcon"></i>
                </button>

                <div class="nav-actions" id="navMenu">
                    <?php
                        $user        = Auth::guard('admin')->user() ?? Auth::guard('client')->user();
                        $isAdmin     = $user instanceof \App\Models\Admin;
                        $isClient    = $user instanceof \App\Models\Client;
                        $logoutRoute = $isAdmin ? route('admin.logout') : ($isClient ? route('client.logout') : '#');
                    ?>

                    <?php if($isAdmin): ?>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link-custom nav-link-with-icon">
                            <i class="fas fa-chart-line"></i><span>Tableau de bord</span>
                        </a>
                        <a href="<?php echo e(route('admin.vetements.index')); ?>" class="nav-link-custom nav-link-with-icon">
                            <i class="fas fa-shirt"></i><span>Vêtements</span>
                        </a>
                        <a href="<?php echo e(route('admin.categories.index')); ?>" class="nav-link-custom nav-link-with-icon">
                            <i class="fas fa-tags"></i><span>Catégories</span>
                        </a>
                        <a href="<?php echo e(route('admin.rendezvous.index')); ?>" class="nav-link-custom nav-link-with-icon">
                            <i class="fas fa-calendar-alt"></i><span>Rendez-vous</span>
                        </a>
                        <a href="<?php echo e(route('admin.clients.index')); ?>" class="nav-link-custom nav-link-with-icon">
                            <i class="fas fa-users"></i><span>Clients</span>
                        </a>
                        <form action="<?php echo e($logoutRoute); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-outline-custom btn-sm">Déconnexion</button>
                        </form>

                    <?php elseif($isClient): ?>
                        <a href="<?php echo e(route('home')); ?>" class="nav-link-custom nav-link-with-icon">
                            <i class="fas fa-house"></i><span>Accueil</span>
                        </a>
                        <a href="<?php echo e(route('vetements.index')); ?>" class="nav-link-custom nav-link-with-icon">
                            <i class="fas fa-shirt"></i><span>Collection</span>
                        </a>
                        <a href="<?php echo e(route('rendezvous.create')); ?>" class="nav-link-custom nav-link-with-icon">
                            <i class="fas fa-calendar-plus"></i><span>Réserver</span>
                        </a>
                        <a href="<?php echo e(route('rendezvous.index')); ?>" class="nav-link-custom nav-link-with-icon">
                            <i class="fas fa-calendar-check"></i><span>Mes rdvs</span>
                        </a>
                        <form action="<?php echo e($logoutRoute); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-outline-custom btn-sm">Déconnexion</button>
                        </form>

                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="nav-link-custom nav-link-with-icon">
                            <i class="fas fa-sign-in-alt"></i><span>Connexion</span>
                        </a>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-primary-custom btn-sm">
                            <i class="fas fa-user-plus me-1"></i> S'inscrire
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="footer-custom">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h4 class="footer-title">COUTURE</h4>
                    <p>Découvrez l'art de la couture sur mesure.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-white mb-3">Liens rapides</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo e(route('home')); ?>" class="footer-link d-block mb-2">Accueil</a></li>
                        <?php if(auth()->guard()->guest()): ?>
                        <li><a href="<?php echo e(route('login')); ?>" class="footer-link d-block mb-2">Connexion</a></li>
                        <li><a href="<?php echo e(route('register')); ?>" class="footer-link d-block mb-2">S'inscrire</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-white mb-3">Contactez-nous</h5>
                    <p><i class="fas fa-envelope me-2"></i> contact@couture.com</p>
                    <p><i class="fas fa-phone me-2"></i> +221 77 123 45 67</p>
                    <div class="mt-3">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.1);">
            <p class="text-center mb-0">&copy; 2024 Couture App. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
    (function () {
        var toggler = document.getElementById('navToggler');
        var menu    = document.getElementById('navMenu');
        var icon    = document.getElementById('navIcon');

        if (!toggler || !menu) return;

        function closeMenu() {
            menu.classList.remove('active');
            if (icon) icon.className = 'fas fa-bars';
        }

        /* Ouvre / ferme au clic du bouton hamburger */
        toggler.addEventListener('click', function (e) {
            e.stopPropagation();
            var isOpen = menu.classList.toggle('active');
            if (icon) icon.className = isOpen ? 'fas fa-times' : 'fas fa-bars';
        });

        /* Ferme au clic sur un lien */
        menu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', closeMenu);
        });

        /* Ferme au scroll */
        window.addEventListener('scroll', function () {
            if (menu.classList.contains('active')) closeMenu();
        }, { passive: true });

        /* Ferme au clic en dehors */
        document.addEventListener('click', function (e) {
            if (!menu.contains(e.target) && !toggler.contains(e.target)) {
                closeMenu();
            }
        });

        /* Ferme avec Escape */
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeMenu();
        });
    })();
    </script>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\fallou\Desktop\projet laravel\couture-app\resources\views/layouts/master.blade.php ENDPATH**/ ?>