<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Couture App')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=Jost:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600;700&family=Lato:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ═══════════════════════════════════════
           VARIABLES
        ═══════════════════════════════════════ */
        :root {
            --primary:       #c9a959;
            --primary-dark:  #a88942;
            --gold:          #c9a959;
            --gold-light:    #e8d4a0;
            --gold-dark:     #9a7d3a;
            --secondary:     #2c3e50;
            --dark:          #1a1a2e;
            --charcoal:      #1a1a1a;
            --charcoal-mid:  #2d2d2d;
            --ivory:         #f8f5ee;
            --warm-gray:     #7a7264;
            --border-gold:   rgba(201,169,89,0.25);
            --light:         #f8f9fa;
            --white:         #ffffff;
            --gray-100:      #f5f5f5;
            --gray-200:      #e9ecef;
            --gray-300:      #dee2e6;
            --gray-400:      #ced4da;
            --gray-500:      #adb5bd;
            --gray-600:      #6c757d;
            --gray-700:      #495057;
            --gray-800:      #343a40;
            --shadow-sm:     0 2px 4px rgba(0,0,0,0.08);
            --shadow:        0 4px 12px rgba(0,0,0,0.1);
            --shadow-lg:     0 8px 24px rgba(0,0,0,0.12);
            --transition:    all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Lato', sans-serif;
            background-color: var(--gray-100);
            color: var(--gray-800);
            line-height: 1.6;
        }

        /* ═══════════════════════════════════════
           DASHBOARD / LIST GLOBAL
        ═══════════════════════════════════════ */
        .rdv-card {
            background: white;
            padding: 1rem;
            border-radius: 16px;
            transition: 0.3s;
            border: 1px solid #eee;
        }
        .rdv-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }

        .stat-card { text-align: center; padding: 1.5rem; }
        .stat-card i { font-size: 1.5rem; background: #eef2ff; padding: 10px; border-radius: 10px; margin-bottom: 10px; }

        .list-card { margin-bottom: 10px; }

        .statut-confirme { border-left: 4px solid #10b981; }
        .statut-attente  { border-left: 4px solid #f59e0b; }
        .statut-refuse   { border-left: 4px solid #ef4444; }

        .status-pill { padding: 4px 10px; border-radius: 999px; font-size: 0.75rem; font-weight: 500; }
        .confirme { background: #d1fae5; color: #065f46; }
        .attente  { background: #fef3c7; color: #92400e; }
        .refuse   { background: #fee2e2; color: #991b1b; }

        .btn-action { background: #6366f1; color: white; padding: 6px 10px; border-radius: 8px; }
        .btn-action.view   { background: var(--primary); color: white; }
        .btn-action.reject { background: #ef4444; color: white; }

        .rdv-page { padding: 2rem 0; min-height: calc(100vh - 200px); }
        .rdv-actions { display: flex; gap: 0.5rem; align-items: center; }

        .badge-waiting   { background-color: #fff3cd; color: #856404; padding: 0.35rem 0.75rem; border-radius: 20px; font-weight: 600; font-size: 0.75rem; }
        .badge-confirmed { background-color: #d4edda; color: #155724; padding: 0.35rem 0.75rem; border-radius: 20px; font-weight: 600; font-size: 0.75rem; }
        .badge-rejected  { background-color: #f8d7da; color: #721c24; padding: 0.35rem 0.75rem; border-radius: 20px; font-weight: 600; font-size: 0.75rem; }

        .rdv-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(201,169,89,0.3); }
        .rdv-header h2 { font-family: 'Playfair Display', serif; color: var(--dark); font-size: 1.75rem; margin-bottom: 0.25rem; }
        .subtitle { color: var(--gray-600); font-size: 0.95rem; }
        .rdv-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1rem; }
        .rdv-info { display: flex; flex-direction: column; gap: 0.25rem; }
        .rdv-client, .rdv-vetement { font-weight: 600; color: var(--dark); font-size: 1rem; }
        .rdv-phone, .rdv-comment   { color: var(--gray-600); font-size: 0.875rem; }
        .rdv-date-block { display: flex; align-items: center; justify-content: center; min-width: 60px; }

        .alert-info-custom { background-color: #d1ecf1; color: #0c5460; }
        .empty-state { text-align: center; padding: 3rem; color: var(--gray-600); }
        .empty-state i { font-size: 3rem; opacity: 0.3; margin-bottom: 1rem; }

        /* ═══════════════════════════════════════
           NAVBAR
        ═══════════════════════════════════════ */
        .navbar-custom {
            background-color: #111;
            border-bottom: 1px solid rgba(201,169,89,0.12);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            overflow: visible;
        }

        .navbar-custom .container {
            flex-wrap: wrap;
            position: relative;
        }

        .navbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            height: 64px;
        }

        @media (min-width: 992px) {
            .navbar-inner {
                justify-content: flex-start;
                gap: 3rem;
            }
            .nav-actions {
                flex: 1; /* étire pour occuper tout l'espace restant */
            }
        }

        .navbar-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.4rem;
            font-weight: 400;
            color: var(--gold) !important;
            letter-spacing: 3px;
            text-decoration: none;
            text-transform: uppercase;
            line-height: 1;
        }

        .navbar-brand p { margin: 0; }

        .navbar-toggler-custom {
            display: none;
            background: none;
            border: 1px solid rgba(201,169,89,0.3);
            font-size: 1rem;
            color: var(--gold);
            cursor: pointer;
            padding: 0.45rem 0.7rem;
            line-height: 1;
            transition: border-color 0.3s;
        }

        .navbar-toggler-custom:hover { border-color: var(--gold); }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.15rem;
        }

        /* ── Réseaux sociaux Navbar ── */
        .nav-socials {
            display: flex;
            align-items: center;
            gap: 0.1rem;
            margin-left: auto;
            padding-left: 0.75rem;
            border-left: 1px solid rgba(255,255,255,0.07);
        }

        .nav-social-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            color: rgba(255,255,255,0.45);
            font-size: 0.8rem;
            text-decoration: none;
            transition: color 0.3s ease, background 0.3s ease;
            border-radius: 2px;
        }

        .nav-social-icon:hover { color: var(--gold); background: rgba(201,169,89,0.08); }
        .nav-social-wa:hover { color: #25d366; background: rgba(37,211,102,0.08); }

        .nav-link-custom {
            font-family: 'Jost', sans-serif;
            font-size: 0.68rem;
            font-weight: 500;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.6) !important;
            padding: 0.5rem 0.85rem !important;
            text-decoration: none;
            transition: color 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .nav-link-custom:hover { color: var(--gold) !important; }
        .nav-link-custom i { font-size: 0.7rem; opacity: 0.7; }

        .nav-link-with-icon { display: inline-flex; align-items: center; gap: 0.4rem; text-decoration: none; }

        /* Séparateur vertical entre liens */
        .nav-actions .nav-link-custom + .nav-link-custom {
            border-left: 1px solid rgba(255,255,255,0.07);
        }

        /* Bouton déconnexion dans la nav */
        .nav-actions .btn-outline-custom {
            font-family: 'Jost', sans-serif;
            font-size: 0.65rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            border: 1px solid rgba(201,169,89,0.4);
            color: var(--gold);
            background: transparent;
            padding: 0.4rem 1rem;
            border-radius: 0;
            font-weight: 400;
            transition: var(--transition);
            margin-left: 0.5rem;
        }

        .nav-actions .btn-outline-custom:hover {
            background: var(--gold);
            border-color: var(--gold);
            color: #111;
        }

        /* Boutons nav (connexion / inscription) */
        .nav-actions .btn-primary-custom {
            font-family: 'Jost', sans-serif;
            font-size: 0.65rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            background: var(--gold);
            border: 1px solid var(--gold);
            color: #111;
            padding: 0.45rem 1.1rem;
            border-radius: 0;
            font-weight: 500;
            transition: var(--transition);
            margin-left: 0.35rem;
        }

        .nav-actions .btn-primary-custom:hover {
            background: var(--gold-light);
            border-color: var(--gold-light);
            color: #111;
        }

        /* ═══════════════════════════════════════
           BOUTONS GLOBAUX
        ═══════════════════════════════════════ */
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
            color: var(--white);
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

        /* ═══════════════════════════════════════
           FORMULAIRES
        ═══════════════════════════════════════ */
        .form-custom { background-color: var(--white); padding: 2.5rem; border-radius: 12px; box-shadow: var(--shadow-lg); }
        .form-control-custom { border: 2px solid var(--gray-200); padding: 0.75rem 1rem; border-radius: 6px; transition: all 0.3s ease; }
        .form-control-custom:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(201,169,89,0.2); outline: none; }
        .form-label-custom { font-weight: 600; color: var(--gray-700); margin-bottom: 0.5rem; display: block; }
        .alert-custom { border-radius: 8px; padding: 0.85rem 1rem; font-size: 0.9rem; }

        /* ═══════════════════════════════════════
           SECTIONS GÉNÉRIQUES
        ═══════════════════════════════════════ */
        .hero-section {
            background: linear-gradient(135deg, var(--dark) 0%, #2d2d4a 100%);
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%; right: -20%;
            width: 60%; height: 200%;
            background: radial-gradient(circle, rgba(201,169,89,0.15) 0%, transparent 70%);
            animation: float 8s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50%       { transform: translateY(-20px) rotate(5deg); }
        }
        .hero-title    { font-size: 3.5rem; font-weight: 700; color: var(--white); line-height: 1.2; margin-bottom: 1.5rem; }
        .hero-subtitle { font-size: 1.25rem; color: var(--gray-300); margin-bottom: 2rem; }

        .section-title { font-size: 2.5rem; font-weight: 600; margin-bottom: 1rem; position: relative; display: inline-block; }
        .section-title::after { content: ''; position: absolute; bottom: -8px; left: 0; width: 60px; height: 3px; background-color: var(--primary); }
        .section-subtitle { color: var(--gray-600); font-size: 1.1rem; margin-bottom: 3rem; }

        .card-custom { background-color: var(--white); border: none; border-radius: 12px; box-shadow: var(--shadow); transition: all 0.3s ease; overflow: hidden; }
        .card-custom:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); }

        /* ═══════════════════════════════════════
           FOOTER
        ═══════════════════════════════════════ */
        .site-footer {
            font-family: 'Jost', sans-serif;
            background: #111;
        }

        /* — CTA band — */
        .footer-cta {
            background: #1a1a1a;
            border-top: 1px solid rgba(201,169,89,0.15);
            border-bottom: 1px solid rgba(201,169,89,0.08);
        }
        .footer-cta-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 3.5rem 3rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
        }
        .footer-cta-tag {
            font-size: 0.62rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 0.5rem;
        }
        .footer-cta-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.6rem, 3vw, 2.4rem);
            font-weight: 300;
            color: #fff;
            line-height: 1.2;
        }
        .footer-cta-title em { font-style: italic; color: var(--gold-light); }

        .footer-cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            background: var(--gold);
            color: #111;
            font-family: 'Jost', sans-serif;
            font-size: 0.72rem;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-decoration: none;
            border: 1px solid var(--gold);
            white-space: nowrap;
            transition: all 0.4s ease;
            flex-shrink: 0;
        }
        .footer-cta-btn:hover { background: var(--gold-light); border-color: var(--gold-light); color: #111; }

        /* — Body — */
        .footer-body {
            max-width: 1280px;
            margin: 0 auto;
            padding: 5rem 3rem 4rem;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.4fr;
            gap: 4rem;
        }

        .footer-col-title {
            font-size: 0.6rem;
            font-weight: 500;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 1.75rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid rgba(201,169,89,0.15);
        }

        /* Brand column */
        .footer-logo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-weight: 400;
            color: #fff;
            letter-spacing: 3px;
            margin-bottom: 1.25rem;
            text-decoration: none;
            display: inline-block;
        }
        .footer-logo span { color: var(--gold); margin: 0 0.2rem; }

        .footer-about {
            font-size: 0.82rem;
            font-weight: 300;
            color: #555;
            line-height: 1.85;
            margin-bottom: 2rem;
            max-width: 280px;
        }

        .footer-socials { display: flex; gap: 0.6rem; }
        .footer-social {
            width: 36px;
            height: 36px;
            border: 1px solid rgba(201,169,89,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #555;
            font-size: 0.75rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .footer-social:hover { border-color: var(--gold); color: var(--gold); background: rgba(201,169,89,0.08); }

        /* Nav & service links */
        .footer-links { list-style: none; display: flex; flex-direction: column; gap: 0.65rem; }

        .footer-nav-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #555;
            font-size: 0.82rem;
            font-weight: 300;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .footer-nav-link i { font-size: 0.45rem; color: var(--gold); opacity: 0; transition: opacity 0.3s ease; }
        .footer-nav-link:hover { color: var(--gold-light); }
        .footer-nav-link:hover i { opacity: 1; }

        /* Contact list */
        .footer-contact-list { list-style: none; display: flex; flex-direction: column; gap: 1rem; }
        .footer-contact-list li { display: flex; align-items: flex-start; gap: 0.75rem; font-size: 0.82rem; font-weight: 300; color: #555; line-height: 1.5; }
        .footer-contact-icon {
            width: 28px;
            height: 28px;
            border: 1px solid rgba(201,169,89,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            font-size: 0.65rem;
            flex-shrink: 0;
            margin-top: 0.05rem;
        }

        /* — Bottom bar — */
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.05); }
        .footer-bottom-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 1.5rem 3rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        .footer-copy { font-size: 0.65rem; color: #333; letter-spacing: 1px; }

        /* Social icon (legacy - autres pages) */
        .social-icon {
            display: inline-flex; align-items: center; justify-content: center;
            width: 40px; height: 40px; border-radius: 50%;
            background-color: rgba(255,255,255,0.1); color: var(--gray-300);
            margin-right: 0.5rem; transition: all 0.3s ease; text-decoration: none;
        }
        .social-icon:hover { background-color: var(--primary); color: var(--white); transform: translateY(-3px); }

        /* ═══════════════════════════════════════
           RESPONSIVE — Tablet (≤ 991px)
        ═══════════════════════════════════════ */
        @media (max-width: 991px) {
            /* Navbar */
            .navbar-toggler-custom { display: block; }
            .navbar-custom { padding: 0; }

            .nav-actions {
                display: none;
                width: 100%;
                position: absolute;
                top: 100%;
                left: 0; right: 0;
                flex-direction: column;
                align-items: flex-start;
                background: #111;
                border-top: 1px solid rgba(201,169,89,0.12);
                box-shadow: 0 8px 24px rgba(0,0,0,0.3);
                padding: 0.5rem 0 0.75rem;
                gap: 0;
                z-index: 999;
            }
            .nav-actions.active { display: flex; }

            .nav-link-custom {
                padding: 0.65rem 1.25rem !important;
                font-size: 0.7rem;
                width: 100%;
                color: rgba(255,255,255,0.65) !important;
                border-left: none !important;
                border-bottom: 1px solid rgba(255,255,255,0.04);
            }
            .nav-link-custom:hover { color: var(--gold) !important; background: rgba(201,169,89,0.05); }

            .nav-actions .btn-outline-custom,
            .nav-actions .btn-primary-custom {
                width: calc(100% - 2.5rem);
                margin: 0.5rem 1.25rem 0;
                text-align: center;
                justify-content: center;
                border-radius: 0;
            }

            .nav-actions form { padding: 0.5rem 1.25rem 0; width: 100%; }
            .nav-actions form .btn { width: 100%; text-align: center; border-radius: 0; }

            .nav-socials {
                margin-left: 0;
                padding: 0.75rem 1.25rem;
                border-left: none;
                border-top: 1px solid rgba(255,255,255,0.04);
                width: 100%;
                gap: 0.5rem;
            }

            .nav-social-icon { width: 36px; height: 36px; font-size: 0.9rem; }

            /* Footer */
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 3rem; }
            .footer-col-brand { grid-column: 1 / -1; }
            .footer-about { max-width: 100%; }
            .footer-cta-inner { flex-direction: column; align-items: flex-start; gap: 1.5rem; }

            /* Sections */
            .hero-section { padding: 3rem 0; }
        }

        /* ═══════════════════════════════════════
           RESPONSIVE — Mobile (≤ 768px)
        ═══════════════════════════════════════ */
        @media (max-width: 768px) {
            .hero-title    { font-size: 2rem; }
            .hero-subtitle { font-size: 1rem; }
            .section-title { font-size: 1.75rem; }
            .section-subtitle { font-size: 1rem; margin-bottom: 2rem; }

            .form-custom    { padding: 1.5rem; }

            /* Footer */
            .footer-body { padding: 3.5rem 1.5rem 3rem; }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 2.5rem; }
            .footer-cta-inner { padding: 2.5rem 1.5rem; }
            .footer-bottom-inner { padding: 1.25rem 1.5rem; flex-direction: column; gap: 0.5rem; text-align: center; }
        }

        /* ═══════════════════════════════════════
           RESPONSIVE — Small mobile (≤ 576px)
        ═══════════════════════════════════════ */
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

            /* Footer */
            .footer-grid { grid-template-columns: 1fr; gap: 2rem; }
            .footer-col-brand { grid-column: auto; }
            .footer-body { padding: 3rem 1rem 2.5rem; }
            .footer-cta-inner { padding: 2rem 1rem; }
            .footer-bottom-inner { padding: 1rem; }
        }

        /* Floating WhatsApp Button */
        .floating-whatsapp {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background-color: #25d366;
            color: #fff !important;
            border-radius: 50%;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .floating-whatsapp:hover {
            background-color: #20ba5a;
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(37, 211, 102, 0.4);
        }
        .floating-whatsapp::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: #25d366;
            opacity: 0.5;
            z-index: -1;
            animation: waPulse 2s infinite;
        }
        @keyframes waPulse {
            0% {
                transform: scale(1);
                opacity: 0.5;
            }
            100% {
                transform: scale(1.6);
                opacity: 0;
            }
        }
    </style>
    @yield('styles')
</head>
<body>

    {{-- ─── NAVBAR ─── --}}
    <nav class="navbar-custom">
        <div class="container">
            <div class="navbar-inner">

                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                    @if(config('app.theme_mode') === 'alternative')
                        <div style="font-family: 'Cormorant Garamond', serif; font-size: 1.5rem; font-weight: 300; letter-spacing: 4px; text-transform: uppercase; color: #fff; line-height: 1;">
                            <span style="color: var(--gold); font-weight: 500;">AURA</span> <span style="font-size: 1.1rem; vertical-align: middle; opacity: 0.8;">Couture</span>
                        </div>
                    @else
                        <img src="{{ asset('logo.png') }}?v=4" alt="SMC Couture" style="height: 55px; width: auto; object-fit: contain; border-radius: 4px;">
                    @endif
                </a>

                <button class="navbar-toggler-custom" id="navToggler" aria-label="Menu">
                    <i class="fas fa-bars" id="navIcon"></i>
                </button>

                <div class="nav-actions" id="navMenu">
                    @php
                        $isAdmin = Auth::guard('admin')->check();
                    @endphp

                    @if($isAdmin)
                        <a href="{{ route('admin.dashboard') }}" class="nav-link-custom">
                            <i class="fas fa-chart-line"></i><span>Tableau de bord</span>
                        </a>
                        <a href="{{ route('admin.vetements.index') }}" class="nav-link-custom">
                            <i class="fas fa-shirt"></i><span>Vêtements</span>
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="nav-link-custom">
                            <i class="fas fa-tags"></i><span>Catégories</span>
                        </a>
                        <a href="{{ route('admin.rendezvous.index') }}" class="nav-link-custom">
                            <i class="fas fa-calendar-alt"></i><span>Rendez-vous</span>
                        </a>
                        <a href="{{ route('admin.clients.index') }}" class="nav-link-custom">
                            <i class="fas fa-users"></i><span>Clients</span>
                        </a>
                        <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-custom btn-sm">Déconnexion</button>
                        </form>
                    @else
                        <a href="{{ route('home') }}" class="nav-link-custom">
                            <i class="fas fa-house"></i><span>Accueil</span>
                        </a>
                        <a href="{{ route('vetements.index') }}" class="nav-link-custom">
                            <i class="fas fa-shirt"></i><span>Collection</span>
                        </a>
                        <a href="{{ route('rendezvous.create') }}" class="nav-link-custom">
                            <i class="fas fa-calendar-plus"></i><span>Réserver</span>
                        </a>

                        {{-- ─ Réseaux sociaux ─ --}}
                        <div class="nav-socials">
                            <a href="https://www.instagram.com" target="_blank" class="nav-social-icon" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://www.facebook.com" target="_blank" class="nav-social-icon" aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://www.tiktok.com" target="_blank" class="nav-social-icon" aria-label="TikTok">
                                <i class="fab fa-tiktok"></i>
                            </a>
                            @php $adminPhone = \App\Models\Admin::first()?->telephone ?? '221771234567'; $waNum = preg_replace('/\D+/', '', $adminPhone); if(strlen($waNum)===9) $waNum='221'.$waNum; @endphp
                            <a href="https://wa.me/{{ $waNum }}" target="_blank" class="nav-social-icon nav-social-wa" aria-label="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </nav>
 
    <main>
        @yield('content')
    </main>
 
    {{-- ─── FOOTER ─── --}}
    <footer class="site-footer">
 
        {{-- Bande CTA --}}
        <div class="footer-cta">
            <div class="footer-cta-inner">
                <div>
                    <p class="footer-cta-tag">Commencez dès aujourd'hui</p>
                    <h2 class="footer-cta-title">Votre création <em>vous attend</em></h2>
                </div>
                <a href="{{ route('rendezvous.create') }}" class="footer-cta-btn">
                    <i class="fas fa-calendar-check" style="font-size:0.65rem;"></i>
                    Prendre rendez-vous
                </a>
            </div>
        </div>
 
        {{-- Corps --}}
        <div class="footer-body">
            <div class="footer-grid">
 
                {{-- Marque --}}
                <div class="footer-col footer-col-brand">
                    @if(config('app.theme_mode') === 'alternative')
                        <a href="{{ route('home') }}" class="footer-logo">AURA<span>—</span>COUTURE</a>
                        <p class="footer-about">
                            Maison de haute couture d'exception. Chaque création est une pièce unique, façonnée pour sublimer votre allure avec raffinement.
                        </p>
                    @else
                        <a href="{{ route('home') }}" class="footer-logo">SMC<span>—</span>COUTURE</a>
                        <p class="footer-about">
                            Maison de couture sur mesure fondée en 2020 à Dakar. Chaque création est unique, pensée pour sublimer votre style avec des matières d'exception.
                        </p>
                    @endif
                    <div class="footer-socials">
                        <a href="#" class="footer-social" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="footer-social" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="footer-social" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" class="footer-social" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
 
                {{-- Navigation --}}
                <div class="footer-col">
                    <h4 class="footer-col-title">Navigation</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}" class="footer-nav-link"><i class="fas fa-chevron-right"></i>Accueil</a></li>
                        <li><a href="{{ route('vetements.index') }}" class="footer-nav-link"><i class="fas fa-chevron-right"></i>Collection</a></li>
                        <li><a href="{{ route('rendezvous.create') }}" class="footer-nav-link"><i class="fas fa-chevron-right"></i>Réserver</a></li>
                    </ul>
                </div>

                {{-- Services --}}
                <div class="footer-col">
                    <h4 class="footer-col-title">Nos services</h4>
                    <ul class="footer-links">
                        <li><a href="#" class="footer-nav-link"><i class="fas fa-chevron-right"></i>Vêtements sur mesure</a></li>
                        <li><a href="#" class="footer-nav-link"><i class="fas fa-chevron-right"></i>Tenues de cérémonie</a></li>
                        <li><a href="#" class="footer-nav-link"><i class="fas fa-chevron-right"></i>Retouches & ajustements</a></li>
                        <li><a href="#" class="footer-nav-link"><i class="fas fa-chevron-right"></i>Conseils personnalisés</a></li>
                        <li><a href="#" class="footer-nav-link"><i class="fas fa-chevron-right"></i>Prise de mesures</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div class="footer-col">
                    <h4 class="footer-col-title">Contact</h4>
                    <ul class="footer-contact-list">
                        <li>
                            <span class="footer-contact-icon"><i class="fas fa-map-marker-alt"></i></span>
                            <span>Dakar, Sénégal</span>
                        </li>
                        <li>
                            <span class="footer-contact-icon"><i class="fas fa-phone"></i></span>
                            <a href="tel:+221771234567" class="footer-nav-link" style="color:#555;">+221 77 123 45 67</a>
                        </li>
                        <li>
                            <span class="footer-contact-icon"><i class="fas fa-envelope"></i></span>
                            <a href="mailto:contact@couture.com" class="footer-nav-link" style="color:#555;">contact@couture.com</a>
                        </li>
                        <li>
                            <span class="footer-contact-icon"><i class="fas fa-clock"></i></span>
                            <span>Lun – Sam : 9h – 19h</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        {{-- Copyright --}}
        <div class="footer-bottom">
            <div class="footer-bottom-inner">
                @if(config('app.theme_mode') === 'alternative')
                    <span class="footer-copy">© {{ date('Y') }} AURA Couture. Tous droits réservés.</span>
                @else
                    <span class="footer-copy">© {{ date('Y') }} SMC Couture. Tous droits réservés.</span>
                @endif
                <span class="footer-copy">Fait avec <i class="fas fa-heart" style="color:var(--gold); font-size:0.55rem;"></i> à Dakar, Sénégal</span>
            </div>
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

        toggler.addEventListener('click', function (e) {
            e.stopPropagation();
            var isOpen = menu.classList.toggle('active');
            if (icon) icon.className = isOpen ? 'fas fa-times' : 'fas fa-bars';
        });

        menu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', closeMenu);
        });

        window.addEventListener('scroll', function () {
            if (menu.classList.contains('active')) closeMenu();
        }, { passive: true });

        document.addEventListener('click', function (e) {
            if (!menu.contains(e.target) && !toggler.contains(e.target)) closeMenu();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeMenu();
        });
    })();
    </script>

    @php
        $adminPhone = \App\Models\Admin::first()?->telephone ?? '221771234567';
        $waPhone = preg_replace('/\D+/', '', $adminPhone);
        if (strlen($waPhone) === 9 && (str_starts_with($waPhone, '77') || str_starts_with($waPhone, '78') || str_starts_with($waPhone, '76') || str_starts_with($waPhone, '70') || str_starts_with($waPhone, '75'))) {
            $waPhone = '221' . $waPhone;
        }
    @endphp
    <a href="https://wa.me/{{ $waPhone }}?text=Bonjour%20SMC%20Couture,%20je%20souhaite%20avoir%20des%20informations." class="floating-whatsapp" target="_blank" aria-label="Contactez-nous sur WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="currentColor">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.713-1.455L0 24zm6.49-3.99c1.65.981 3.272 1.498 4.795 1.5 5.539 0 10.043-4.507 10.046-10.05.001-2.686-1.042-5.212-2.93-7.103-1.89-1.89-4.412-2.932-7.102-2.933-5.546 0-10.05 4.507-10.053 10.051-.002 1.902.501 3.757 1.456 5.416l-.99 3.61 3.712-.973zm12.337-5.69c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
        </svg>
    </a>

    <script>
    (function() {
        function makeLogoTransparent() {
            var logoImg = document.querySelector(".navbar-brand img");
            if (!logoImg || logoImg.dataset.processed) return;
            
            var tempImg = new Image();
            tempImg.src = logoImg.src;
            
            var process = function() {
                var canvas = document.createElement("canvas");
                canvas.width = tempImg.width;
                canvas.height = tempImg.height;
                var ctx = canvas.getContext("2d");
                ctx.drawImage(tempImg, 0, 0);
                
                try {
                    var imgData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                    var data = imgData.data;
                    
                    for (var i = 0; i < data.length; i += 4) {
                        var r = data[i];
                        var g = data[i+1];
                        var b = data[i+2];
                        
                        // Si le pixel est neutre (blanc/gris du damier), on le rend transparent.
                        // Les teintes de gris ont des canaux R, G, B très proches les uns des autres.
                        var diffRG = Math.abs(r - g);
                        var diffRB = Math.abs(r - b);
                        var diffGB = Math.abs(g - b);
                        
                        if (diffRG < 20 && diffRB < 20 && diffGB < 20) {
                            data[i+3] = 0; // alpha = 0 (transparent)
                        }
                    }
                    ctx.putImageData(imgData, 0, 0);
                    logoImg.src = canvas.toDataURL("image/png");
                    logoImg.dataset.processed = "true";
                    logoImg.style.visibility = "visible";
                } catch(e) {
                    // Fallback en cas de soucis CORS (très peu probable en local/prod relative)
                    logoImg.style.visibility = "visible";
                }
            };
            
            if (tempImg.complete) {
                process();
            } else {
                logoImg.style.visibility = "hidden";
                tempImg.onload = process;
            }
        }
        
        if (document.readyState === "loading") {
            document.addEventListener("DOMContentLoaded", makeLogoTransparent);
        } else {
            makeLogoTransparent();
        }
    })();
    </script>

    @yield('scripts')
</body>
</html>