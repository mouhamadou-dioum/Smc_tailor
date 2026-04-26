<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Couture App')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Lato:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #c9a959;
            --primary-dark: #a88942;
            --dark: #1a1a2e;
            --white: #ffffff;
            --gray-100: #f5f5f5;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-400: #ced4da;
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

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            color: var(--dark);
        }

        /* ── Navbar ── */
        .navbar-custom {
            background-color: var(--white);
            box-shadow: var(--shadow-sm);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            /* ✅ Permet au menu de pousser le contenu vers le bas */
            overflow: visible;
        }

        .navbar-custom .container {
            /* ✅ Permet le retour à la ligne du menu */
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

        /* Menu - desktop */
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

        /* ── Buttons ── */
        .btn-primary-custom {
            background-color: var(--primary);
            border-color: var(--primary);
            color: var(--white);
            padding: 0.5rem 1rem;
            font-weight: 600;
            border-radius: 4px;
            transition: all 0.3s ease;
            font-size: 0.875rem;
        }

        .btn-primary-custom:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-outline-custom {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 0.4rem 1rem;
            font-weight: 600;
            border-radius: 4px;
            transition: all 0.3s ease;
            font-size: 0.875rem;
        }

        .btn-outline-custom:hover {
            background-color: var(--primary);
            color: var(--white);
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

        /* ── Hero ── */
        .hero-section {
            background: linear-gradient(135deg, var(--dark) 0%, #2d2d4a 100%);
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
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

        /* ── Featured card ── */
        .featured-card {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
        }

        .featured-card img {
              width: 100%;
                height: 420px;
                object-fit: cover;        /* ✅ était "contain", qui laisse des espaces vides */
                object-position: top;     /* ✅ cadre sur le haut pour ne pas couper la tête */
                background-color: var(--gray-100);
                transition: transform 0.5s ease;
        }

        .featured-card:hover img { transform: scale(1.1); }

        .price-tag {
            background-color: var(--primary);
            color: var(--white);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.875rem;
        }

        /* ── Forms ── */
        .form-custom {
            background-color: var(--white);
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
        }

        .form-control-custom {
            border: 2px solid var(--gray-200);
            padding: 0.75rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .form-control-custom:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(201,169,89,0.2);
        }

        .form-label-custom {
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

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

        .footer-link {
            color: var(--gray-400);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-link:hover { color: var(--primary); }

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

        /* ── Alerts & Badges ── */
        .alert-custom {
            border: none;
            border-radius: 8px;
            padding: 1rem 1.5rem;
            font-weight: 500;
        }

        .alert-success-custom { background-color: #d4edda; color: #155724; }
        .alert-error-custom   { background-color: #f8d7da; color: #721c24; }

        .badge-waiting   { background-color: #fff3cd; color: #856404; padding: 0.35rem 0.75rem; border-radius: 20px; font-weight: 600; font-size: 0.75rem; }
        .badge-confirmed { background-color: #d4edda; color: #155724; padding: 0.35rem 0.75rem; border-radius: 20px; font-weight: 600; font-size: 0.75rem; }
        .badge-rejected  { background-color: #f8d7da; color: #721c24; padding: 0.35rem 0.75rem; border-radius: 20px; font-weight: 600; font-size: 0.75rem; }

        /* ════════════════════════════════════════
           RESPONSIVE — Tablet (≤991px)
           ✅ Menu en position relative → pousse
              le contenu vers le bas sans rien cacher
        ════════════════════════════════════════ */
        @media (max-width: 991px) {
            .navbar-toggler-custom { display: block; }

            .navbar-custom {
                padding: 0.5rem 0;
            }

            /* ✅ Le conteneur doit autoriser le retour à la ligne */
            .navbar-custom .container,
            .navbar-custom .navbar-wrapper {
                flex-wrap: wrap;
                align-items: center;
            }

            .navbar-brand { font-size: 1.3rem; }

            .nav-actions {
                /* ✅ Masqué par défaut */
                display: none;

                /* ✅ Position relative : le menu s'insère dans le flux
                      et pousse le contenu en dessous au lieu de le couvrir */
                position: relative;
                top: auto;
                right: auto;
                left: auto;
                transform: none;

                width: 100%;
                flex-direction: column;
                align-items: flex-start;

                background: var(--white);
                border-top: 2px solid var(--primary);
                border-radius: 0 0 8px 8px;
                padding: 0.5rem;
                gap: 0.25rem;
                box-shadow: var(--shadow-lg);

                /* ✅ Animation d'ouverture douce */
                animation: none;
            }

            /* ✅ Quand le menu est ouvert */
            .nav-actions.active {
                display: flex;
            }

            .nav-link-custom {
                padding: 0.5rem 0.75rem !important;
                width: 100%;
                border-bottom: 1px solid var(--gray-200);
                text-align: left;
                font-size: 0.9rem;
            }

            .nav-link-custom:last-child { border-bottom: none; }

            .nav-actions form {
                width: 100%;
                padding: 0;
            }

            .nav-actions form .btn,
            .nav-actions > a.btn {
                width: 100%;
                font-size: 0.8rem;
                padding: 0.4rem 0.75rem;
                margin-top: 0.25rem;
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
    @yield('styles')
</head>
<body>
    <nav class="navbar-custom">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap w-100 navbar-wrapper">
                <a class="navbar-brand" href="{{ route('home') }}">COUTURE</a>

                <button class="navbar-toggler-custom" id="navToggler" aria-label="Menu">
                    <i class="fas fa-bars" id="navIcon"></i>
                </button>

                <div class="nav-actions" id="navMenu">
                    @php
                        $user        = Auth::guard('admin')->user() ?? Auth::guard('client')->user();
                        $isAdmin     = $user instanceof \App\Models\Admin;
                        $isClient    = $user instanceof \App\Models\Client;
                        $logoutRoute = $isAdmin ? route('admin.logout') : ($isClient ? route('client.logout') : '#');
                    @endphp

                    @if($isAdmin)
                        <a href="{{ route('admin.dashboard') }}" class="nav-link-custom nav-link-with-icon">
                            <i class="fas fa-chart-line"></i><span>Tableau de bord</span>
                        </a>
                        <a href="{{ route('admin.vetements.index') }}" class="nav-link-custom nav-link-with-icon">
                            <i class="fas fa-shirt"></i><span>Vêtements</span>
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="nav-link-custom nav-link-with-icon">
                            <i class="fas fa-tags"></i><span>Catégories</span>
                        </a>
                        <a href="{{ route('admin.rendezvous.index') }}" class="nav-link-custom nav-link-with-icon">
                            <i class="fas fa-calendar-alt"></i><span>Rendez-vous</span>
                        </a>
                        <a href="{{ route('admin.clients.index') }}" class="nav-link-custom nav-link-with-icon">
                            <i class="fas fa-users"></i><span>Clients</span>
                        </a>
                        <form action="{{ $logoutRoute }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-custom btn-sm">Déconnexion</button>
                        </form>

                    @elseif($isClient)
                        <a href="{{ route('home') }}" class="nav-link-custom nav-link-with-icon">
                            <i class="fas fa-house"></i><span>Accueil</span>
                        </a>
                        <a href="{{ route('vetements.index') }}" class="nav-link-custom nav-link-with-icon">
                            <i class="fas fa-shirt"></i><span>Collection</span>
                        </a>
                        <a href="{{ route('rendezvous.create') }}" class="nav-link-custom nav-link-with-icon">
                            <i class="fas fa-calendar-plus"></i><span>Réserver</span>
                        </a>
                        <a href="{{ route('rendezvous.index') }}" class="nav-link-custom nav-link-with-icon">
                            <i class="fas fa-calendar-check"></i><span>Mes rdvs</span>
                        </a>
                        <form action="{{ $logoutRoute }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-custom btn-sm">Déconnexion</button>
                        </form>

                    @else
                        <a href="{{ route('login') }}" class="nav-link-custom nav-link-with-icon">
                            <i class="fas fa-sign-in-alt"></i><span>Connexion</span>
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary-custom btn-sm">
                            <i class="fas fa-user-plus me-1"></i> S'inscrire
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
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
                        <li><a href="{{ route('home') }}" class="footer-link d-block mb-2">Accueil</a></li>
                        @guest
                        <li><a href="{{ route('login') }}" class="footer-link d-block mb-2">Connexion</a></li>
                        <li><a href="{{ route('register') }}" class="footer-link d-block mb-2">S'inscrire</a></li>
                        @endguest
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
    <script src="{{ asset('js/app.js') }}"></script>

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

    @yield('scripts')
</body>
</html>