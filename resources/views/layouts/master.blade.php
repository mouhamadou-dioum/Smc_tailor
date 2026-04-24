<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Couture sur mesure - Réservez vos rendez-vous pour des vêtements personnalisés">
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
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary) !important;
            letter-spacing: 1px;
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

        .nav-link-custom {
            color: var(--gray-700) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link-custom:hover { color: var(--primary) !important; }

        .nav-link-custom::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background-color: var(--primary);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link-custom:hover::after { width: 80%; }

        .nav-link-with-icon {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            text-decoration: none;
        }

        .nav-link-with-icon i {
            width: 1.15rem;
            text-align: center;
            opacity: 0.92;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            row-gap: 0.5rem;
        }

        /* ── Buttons ── */
        .btn-primary-custom {
            background-color: var(--primary);
            border-color: var(--primary);
            color: var(--white);
            padding: 0.625rem 1.5rem;
            font-weight: 600;
            border-radius: 4px;
            transition: all 0.3s ease;
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
            padding: 0.5rem 1.25rem;
            font-weight: 600;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            background-color: var(--primary);
            color: var(--white);
        }

        .btn-admin {
            background-color: var(--secondary);
            border-color: var(--secondary);
            color: var(--white);
            padding: 0.625rem 1.5rem;
            font-weight: 600;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .btn-admin:hover {
            background-color: var(--dark);
            border-color: var(--dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
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

        /* ── Featured card ── */
        .featured-card {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
        }

        .featured-card img {
            width: 100%;
            height: 420px;
            object-fit: contain;
            background-color: var(--gray-100);
            transition: transform 0.5s ease;
        }

        .featured-card:hover img { transform: scale(1.1); }

        .featured-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 100%);
            padding: 2rem 1.5rem 1.5rem;
            color: var(--white);
        }

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

        .footer-link:hover {
            color: var(--primary);
            padding-left: 5px;
        }

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

        .badge-custom {
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.75rem;
        }

        .badge-waiting   { background-color: #fff3cd; color: #856404; }
        .badge-confirmed { background-color: #d4edda; color: #155724; }
        .badge-rejected  { background-color: #f8d7da; color: #721c24; }
        .badge-admin     { background-color: var(--secondary); color: var(--white); }
        .badge-client    { background-color: var(--primary); color: var(--white); }

        /* ── Animations ── */
        .fade-in { animation: fadeIn 0.5s ease-in-out; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .slide-up { animation: slideUp 0.6s ease-out; }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Tables ── */
        .table-custom {
            background-color: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .table-custom thead { background-color: var(--primary); color: var(--white); }

        .table-custom th, .table-custom td {
            padding: 1rem;
            vertical-align: middle;
        }

        .table-custom tbody tr { transition: all 0.3s ease; }
        .table-custom tbody tr:hover { background-color: var(--gray-100); }

        /* ── Stat cards ── */
        .stat-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-icon-primary   { background-color: rgba(201,169,89,0.15); color: var(--primary); }
        .stat-icon-secondary { background-color: rgba(44,62,80,0.15);   color: var(--secondary); }
        .stat-icon-success   { background-color: rgba(40,167,69,0.15);  color: #28a745; }
        .stat-icon-warning   { background-color: rgba(255,193,7,0.15);  color: #ffc107; }

        /* ════════════════════════════════
           RESPONSIVE — Tablet (≤991px)
           Menu hamburger activé
        ════════════════════════════════ */
        @media (max-width: 991px) {
            .navbar-toggler-custom { display: block; }

            .nav-actions {
                display: none;
                width: 100%;
                flex-direction: column;
                align-items: flex-start;
                padding-top: 1rem;
                border-top: 1px solid var(--gray-200);
                margin-top: 1rem;
            }

            .nav-actions.active { display: flex; }

            .nav-link-custom {
                padding: 0.75rem 0 !important;
                width: 100%;
                border-bottom: 1px solid var(--gray-100);
            }

            .nav-actions form { width: 100%; }

            .nav-actions .btn {
                width: 100%;
                text-align: center;
                margin-top: 0.5rem;
            }

            .hero-section { padding: 4rem 0; }
        }

        /* ════════════════════════════════
           RESPONSIVE — Mobile (≤768px)
        ════════════════════════════════ */
        @media (max-width: 768px) {
            .hero-title    { font-size: 2rem; }
            .hero-subtitle { font-size: 1rem; }
            .section-title { font-size: 1.75rem; }
            .section-subtitle { font-size: 1rem; margin-bottom: 2rem; }

            .navbar-custom { padding: 0.75rem 0; }
            .navbar-brand  { font-size: 1.4rem; }

            .form-custom   { padding: 1.5rem; }
            .footer-custom { padding: 2.5rem 0 1.5rem; }
            .footer-title  { font-size: 1.25rem; }

            .featured-card img { height: 300px; }

            .card-custom { padding: 1rem; }

            .table-custom th, .table-custom td { padding: 0.75rem; }
            .stat-card { padding: 1.25rem; }
        }

        /* ════════════════════════════════
           RESPONSIVE — Small mobile (≤576px)
        ════════════════════════════════ */
        @media (max-width: 576px) {
            .hero-title    { font-size: 1.6rem; }
            .hero-subtitle { font-size: 0.95rem; }
            .section-title { font-size: 1.4rem; }

            h2 { font-size: 1.4rem; }
            h3 { font-size: 1.2rem; }

            .btn    { padding: 0.5rem 1rem; font-size: 0.875rem; }
            .btn-sm { padding: 0.375rem 0.75rem; font-size: 0.8rem; }

            .form-custom         { padding: 1.25rem; }
            .form-control-custom { padding: 0.625rem 0.875rem; font-size: 0.9rem; }

            .featured-card img { height: 220px; }

            .footer-custom .col-md-4 { margin-bottom: 1.5rem; }

            .table-custom th, .table-custom td { padding: 0.625rem; font-size: 0.875rem; }

            .stat-card  { padding: 1rem; }
            .stat-icon  { width: 48px; height: 48px; font-size: 1.25rem; }

            .hero-section { padding: 3rem 0; }
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar-custom">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <a class="navbar-brand" href="{{ route('home') }}">COUTURE</a>

                {{-- Bouton hamburger (visible ≤991px) --}}
                <button class="navbar-toggler-custom"
                        onclick="document.querySelector('.nav-actions').classList.toggle('active')"
                        aria-label="Menu">
                    <i class="fas fa-bars"></i>
                </button>

<div class="d-flex align-items-center nav-actions">
                    @php
                        $authUser = null;
                        try {
                            $authUser = \Illuminate\Support\Facades\Auth::guard('admin')->user();
                            if (!$authUser) {
                                $authUser = \Illuminate\Support\Facades\Auth::guard('client')->user();
                            }
                        } catch (\Exception $e) {
                            $authUser = null;
                        }
                        $isAdmin = $authUser instanceof \App\Models\Admin;
                        $isClient = $authUser instanceof \App\Models\Client;
                        $logoutRoute = $isAdmin ? route('admin.logout') : ($isClient ? route('client.logout') : '#');
                    @endphp

                    @if($isAdmin)
                        <a href="{{ route('admin.dashboard') }}" class="nav-link-custom nav-link-with-icon me-2 me-md-3">
                            <i class="fas fa-chart-line"></i><span>Tableau de bord</span>
                        </a>
                        <a href="{{ route('admin.vetements.index') }}" class="nav-link-custom nav-link-with-icon me-2 me-md-3">
                            <i class="fas fa-shirt"></i><span>Vêtements</span>
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="nav-link-custom nav-link-with-icon me-2 me-md-3">
                            <i class="fas fa-tags"></i><span>Catégories</span>
                        </a>
                        <a href="{{ route('admin.rendezvous.index') }}" class="nav-link-custom nav-link-with-icon me-2 me-md-3">
                            <i class="fas fa-calendar-alt"></i><span>Rendez-vous</span>
                        </a>
                        <a href="{{ route('admin.clients.index') }}" class="nav-link-custom nav-link-with-icon me-2 me-md-3">
                            <i class="fas fa-users"></i><span>Clients</span>
                        </a>
                        <form action="{{ $logoutRoute }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-custom btn-sm">
                                <i class="fas fa-right-from-bracket me-1"></i> Déconnexion
                            </button>
                        </form>

                    @elseif($isClient)
                        <a href="{{ route('home') }}" class="nav-link-custom nav-link-with-icon me-2 me-md-3">
                            <i class="fas fa-house"></i><span>Accueil</span>
                        </a>
                        <a href="{{ route('vetements.index') }}" class="nav-link-custom nav-link-with-icon me-2 me-md-3">
                            <i class="fas fa-shirt"></i><span>Collection</span>
                        </a>
                        <a href="{{ route('rendezvous.create') }}" class="nav-link-custom nav-link-with-icon me-2 me-md-3">
                            <i class="fas fa-calendar-plus"></i><span>Réserver</span>
                        </a>
                        <a href="{{ route('rendezvous.index') }}" class="nav-link-custom nav-link-with-icon me-2 me-md-3">
                            <i class="fas fa-calendar-check"></i><span>Mes rendez-vous</span>
                        </a>
                        <form action="{{ $logoutRoute }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-custom btn-sm">
                                <i class="fas fa-right-from-bracket me-1"></i> Déconnexion
                            </button>
                        </form>

                    @else
                        <a href="{{ route('login') }}" class="nav-link-custom nav-link-with-icon me-2 me-md-3">
                            <i class="fas fa-right-to-bracket"></i><span>Connexion</span>
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
                    <p>Découvrez l'art de la couture sur mesure. Nous créons des pièces uniques qui mettraient en valeur votre style et votre personnalité.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-white mb-3">Liens rapides</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="footer-link d-block mb-2">Accueil</a></li>
                        {{-- Lien connexion/inscription uniquement pour les visiteurs non connectés --}}
                        @guest('client')
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

    @yield('scripts')
    @yield('extraScripts')
</body>
</html>
