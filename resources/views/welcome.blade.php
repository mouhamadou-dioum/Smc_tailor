@extends('layouts.master')

@section('title', 'Accueil — SMC Couture')

@section('styles')
<style>
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Jost:wght@300;400;500;600&display=swap');

:root {
    --gold: #C9A959;
    --gold-light: #E8D4A0;
    --gold-dark: #9A7D3A;
    --ivory: #F8F5EE;
    --charcoal: #1A1A1A;
    --charcoal-mid: #2D2D2D;
    --warm-gray: #7A7264;
    --border-gold: rgba(201,169,89,0.25);
    --transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}

*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'Jost', sans-serif;
    background: var(--ivory);
    color: var(--charcoal);
    overflow-x: hidden;
}

/* ─── HERO ─── */
.hero {
    min-height: 100svh;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: flex-end;
}

.hero-bg {
    position: absolute;
    inset: 0;
    background: url("{{ asset('heros5.png') }}") center/cover no-repeat;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to top,
        rgba(10,10,10,0.92) 0%,
        rgba(10,10,10,0.55) 40%,
        rgba(10,10,10,0.15) 100%
    );
}

.hero-content {
    position: relative;
    z-index: 2;
    width: 100%;
    padding: 0 5rem 5.5rem;
    display: grid;
    grid-template-columns: 1fr auto;
    align-items: flex-end;
    gap: 4rem;
}

.hero-year {
    font-family: 'Jost', sans-serif;
    font-size: 0.68rem;
    font-weight: 500;
    letter-spacing: 4px;
    color: var(--gold);
    text-transform: uppercase;
    margin-bottom: 1.75rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}



.hero-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(5rem, 9vw, 9rem);
    font-weight: 300;
    color: #fff;
    line-height: 0.95;
    margin-bottom: 0;
    letter-spacing: -1px;
}

.hero-title em {
    font-style: italic;
    color: var(--gold-light);
    display: inline;
}

.hero-side {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 2rem;
    padding-bottom: 0.5rem;
    min-width: 220px;
}

.hero-tagline {
    font-size: 0.72rem;
    font-weight: 400;
    letter-spacing: 2.5px;
    color: rgba(255,255,255,0.45);
    text-transform: uppercase;
    text-align: right;
    line-height: 1.9;
    padding-top: 0;
}

.hero-actions {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    width: 100%;
}

/* Scroll indicator removed */

.btn-gold {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    padding: 1rem 2rem;
    background: var(--charcoal);
    color: var(--gold-light);
    font-family: 'Jost', sans-serif;
    font-size: 0.75rem;
    font-weight: 500;
    letter-spacing: 2px;
    text-transform: uppercase;
    text-decoration: none;
    border: 1px solid var(--charcoal);
    transition: var(--transition);
}

.btn-gold:hover {
    background: var(--gold);
    border-color: var(--gold);
    color: var(--charcoal);
}

.btn-outline-gold {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    padding: 1rem 2rem;
    background: transparent;
    color: var(--charcoal);
    font-family: 'Jost', sans-serif;
    font-size: 0.75rem;
    font-weight: 500;
    letter-spacing: 2px;
    text-transform: uppercase;
    text-decoration: none;
    border: 1px solid var(--charcoal);
    transition: var(--transition);
}

.btn-outline-gold:hover {
    background: var(--charcoal);
    color: var(--gold-light);
}

/* ─── MARQUEE ─── */
.marquee-strip {
    background: var(--gold);
    padding: 0.9rem 0;
    overflow: hidden;
    white-space: nowrap;
}

.marquee-inner {
    display: inline-block;
    animation: marquee 22s linear infinite;
}

@keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }

.marquee-inner span {
    font-size: 0.7rem;
    font-weight: 500;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--charcoal);
    margin: 0 2.5rem;
}

.marquee-inner span::before {
    content: '✦';
    margin-right: 2.5rem;
    opacity: 0.5;
}

/* ─── SECTION BASE ─── */
.section { padding: 7rem 0; background: #ffffff; }
.section-alt { background: #ffffff; }
.section-warm { background: #ffffff; }

.container { max-width: 1280px; margin: 0 auto; padding: 0 3rem; }

.label-row {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.25rem;
}

.label-line {
    width: 32px;
    height: 1px;
    background: var(--gold);
}

.section-label {
    font-size: 0.65rem;
    font-weight: 500;
    letter-spacing: 3.5px;
    text-transform: uppercase;
    color: var(--gold);
}

.section-heading {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(2.2rem, 4vw, 3.5rem);
    font-weight: 300;
    color: var(--charcoal);
    line-height: 1.15;
}

.section-heading em { font-style: italic; color: var(--gold-dark); }
.section-alt .section-heading { color: var(--charcoal); }
.section-alt .section-heading em { color: var(--gold-dark); }

.section-body {
    font-size: 0.95rem;
    font-weight: 300;
    color: var(--warm-gray);
    line-height: 1.85;
    max-width: 440px;
}
.section-alt .section-body { color: var(--warm-gray); }

/* ─── STATS ─── */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    border-top: 1px solid var(--border-gold);
    border-left: 1px solid var(--border-gold);
}

.stat-item {
    padding: 3rem 2rem;
    border-bottom: 1px solid var(--border-gold);
    border-right: 1px solid var(--border-gold);
    text-align: center;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.stat-item::after {
    content: '';
    position: absolute;
    inset: 0;
    background: var(--charcoal);
    transform: translateY(100%);
    transition: var(--transition);
    z-index: 0;
}

.stat-item:hover::after { transform: translateY(0); }

.stat-item > * { position: relative; z-index: 1; }

.stat-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 3.5rem;
    font-weight: 300;
    color: var(--charcoal);
    line-height: 1;
    margin-bottom: 0.4rem;
    transition: color 0.4s ease;
}

.stat-item:hover .stat-num { color: var(--gold-light); }

.stat-icon-sm {
    display: block;
    width: 32px;
    height: 1px;
    background: var(--gold);
    margin: 0 auto 1.25rem;
    transition: width 0.4s ease;
}

.stat-item:hover .stat-icon-sm { width: 48px; }

.stat-lbl {
    font-size: 0.68rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--warm-gray);
    transition: color 0.4s ease;
}

.stat-item:hover .stat-lbl { color: var(--gold); }

/* ─── SERVICES ─── */
.services-intro {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 5rem;
    align-items: start;
    margin-bottom: 4rem;
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2px;
    background: var(--border-gold);
    border: 1px solid var(--border-gold);
}

.service-item {
    background: var(--ivory);
    padding: 3.5rem 2.5rem;
    transition: var(--transition);
    cursor: default;
}

.service-item:hover { background: var(--charcoal); }

.service-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 4rem;
    font-weight: 300;
    color: var(--border-gold);
    line-height: 1;
    margin-bottom: 1.5rem;
    transition: color 0.4s ease;
}

.service-item:hover .service-num { color: rgba(201,169,89,0.15); }

.service-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.45rem;
    font-weight: 400;
    color: var(--charcoal);
    margin-bottom: 1rem;
    transition: color 0.4s ease;
}

.service-item:hover .service-title { color: var(--gold-light); }

.service-desc {
    font-size: 0.85rem;
    font-weight: 300;
    color: var(--warm-gray);
    line-height: 1.8;
    transition: color 0.4s ease;
}

.service-item:hover .service-desc { color: rgba(255, 255, 255, 0.75); }

.service-arrow {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 2rem;
    font-size: 0.65rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--gold);
    opacity: 0;
    transform: translateX(-8px);
    transition: var(--transition);
}

.service-item:hover .service-arrow { opacity: 1; transform: translateX(0); }

/* ─── COLLECTION ─── */
.collection-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 3rem;
    gap: 2rem;
}

.collection-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}

.vet-card {
    display: flex;
    flex-direction: column;
    background: #fff;
    overflow: hidden;
    transition: var(--transition);
    border: 1px solid var(--border-gold);
}

.vet-card:hover { transform: translateY(-6px); box-shadow: 0 30px 60px rgba(0,0,0,0.1); }

.vet-img-wrap {
    position: relative;
    aspect-ratio: 3/4;
    overflow: hidden;
    background: #F0EBE0;
}

.vet-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
    transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
}

.vet-card:hover .vet-img-wrap img { transform: scale(1.08); }

.vet-cat {
    position: absolute;
    top: 1.25rem;
    left: 1.25rem;
    font-size: 0.65rem;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--charcoal);
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(201, 169, 89, 0.3);
    padding: 0.4rem 0.9rem;
    z-index: 2;
}

.vet-img-wrap::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(26,26,26,0.3) 0%, transparent 40%);
    opacity: 0.8;
    transition: opacity 0.5s ease;
    z-index: 1;
    pointer-events: none;
}

.vet-card:hover .vet-img-wrap::before {
    opacity: 1;
}

.vet-body {
    padding: 1.75rem 1.5rem 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.vet-info-row {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    gap: 0.75rem;
    margin-bottom: 0.75rem;
}

.vet-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.35rem;
    font-weight: 500;
    color: var(--charcoal);
    margin-bottom: 0;
    line-height: 1.2;
}

.vet-price-tag {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--gold-dark);
    white-space: nowrap;
}

.vet-desc {
    font-size: 0.8rem;
    font-weight: 300;
    color: var(--warm-gray);
    line-height: 1.7;
    flex: 1;
    margin-bottom: 1.5rem;
}

.vet-btn {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.85rem 1.2rem;
    background: transparent;
    color: var(--charcoal);
    font-size: 0.68rem;
    font-weight: 500;
    letter-spacing: 2px;
    text-transform: uppercase;
    text-decoration: none;
    border: 1px solid var(--gold);
    transition: var(--transition);
}

.vet-btn:hover { background: var(--charcoal); border-color: var(--charcoal); color: var(--gold-light); }

.vet-btn-wa {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.85rem 1.2rem;
    background: #25d366;
    color: #fff !important;
    font-size: 0.68rem;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    text-decoration: none;
    border: 1px solid #25d366;
    transition: var(--transition);
}

.vet-btn-wa:hover {
    background: #20ba5a;
    border-color: #20ba5a;
    color: #fff !important;
}

/* ─── PROCESS ─── */
.process-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0;
    position: relative;
}

.process-grid::after {
    content: '';
    position: absolute;
    top: 28px;
    left: 12.5%;
    right: 12.5%;
    height: 1px;
    background: linear-gradient(to right, transparent, var(--gold), transparent);
}

.step-item {
    padding: 0 1.5rem;
    text-align: center;
}

.step-dot {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    border: 1px solid var(--gold);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.3rem;
    font-weight: 300;
    color: var(--gold);
    margin: 0 auto 2rem;
    background: #ffffff;
    position: relative;
    z-index: 1;
    transition: var(--transition);
}

.step-item:hover .step-dot {
    background: var(--gold);
    color: var(--charcoal);
    transform: scale(1.1);
}

.step-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.15rem;
    font-weight: 400;
    color: var(--charcoal);
    margin-bottom: 0.75rem;
}

.step-desc {
    font-size: 0.78rem;
    font-weight: 300;
    color: #6A6458;
    line-height: 1.75;
}

/* ─── TESTIMONIALS ─── */
.testi-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}

.testi-card {
    background: #F2EDE3;
    padding: 2.5rem;
    border-top: 3px solid var(--gold);
    transition: var(--transition);
}

.testi-card:hover {
    background: var(--charcoal);
    transform: translateY(-4px);
}

.testi-quote {
    font-family: 'Cormorant Garamond', serif;
    font-size: 3rem;
    font-weight: 300;
    color: var(--gold);
    line-height: 0.5;
    margin-bottom: 1.25rem;
}

.testi-text {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.1rem;
    font-weight: 300;
    font-style: italic;
    color: var(--charcoal-mid);
    line-height: 1.8;
    margin-bottom: 1.75rem;
    transition: color 0.4s ease;
}

.testi-card:hover .testi-text { color: #D0C8B8; }

.testi-stars {
    color: var(--gold);
    font-size: 0.7rem;
    letter-spacing: 2px;
    margin-bottom: 1.25rem;
}

.testi-footer {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.testi-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 1px solid var(--border-gold);
}

.testi-name {
    font-size: 0.82rem;
    font-weight: 500;
    color: var(--charcoal);
    transition: color 0.4s ease;
}

.testi-card:hover .testi-name { color: var(--gold-light); }

.testi-role {
    font-size: 0.7rem;
    color: var(--warm-gray);
    letter-spacing: 1px;
    transition: color 0.4s ease;
}

.testi-card:hover .testi-role { color: #6A6458; }

/* Contact styles removed */

/* ─── ANIMATE IN & SMOOTH SCROLL ─── */
html {
    scroll-behavior: smooth;
}

/* Scroll Reveal System */
[data-reveal] {
    opacity: 0;
    transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1), transform 0.85s cubic-bezier(0.16, 1, 0.3, 1);
}

[data-reveal="fade-up"] {
    transform: translateY(40px);
}

[data-reveal="fade-down"] {
    transform: translateY(-40px);
}

[data-reveal="fade-left"] {
    transform: translateX(-40px);
}

[data-reveal="fade-right"] {
    transform: translateX(40px);
}

[data-reveal="zoom-in"] {
    transform: scale(0.93);
}

[data-reveal].revealed {
    opacity: 1;
    transform: translate(0) scale(1);
}

/* Hero page load animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInBg {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.hero-bg {
    animation: fadeInBg 2.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

.hero-year {
    opacity: 0;
    animation: fadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    animation-delay: 0.2s;
}

.hero-title {
    opacity: 0;
    animation: fadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    animation-delay: 0.4s;
}

.hero-side .hero-tagline {
    opacity: 0;
    animation: fadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    animation-delay: 0.6s;
}

.hero-side .hero-actions {
    opacity: 0;
    animation: fadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    animation-delay: 0.8s;
}

/* Scroll indicator animation removed */

/* Premium micro-interactions for Collection cards */
.vet-card {
    position: relative;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.6s cubic-bezier(0.16, 1, 0.3, 1) !important;
}

.vet-card::before {
    content: '';
    position: absolute;
    inset: 0;
    border: 1.5px solid var(--gold);
    opacity: 0;
    transition: opacity 0.4s ease;
    pointer-events: none;
    z-index: 10;
}

.vet-card:hover::before {
    opacity: 1;
}

.vet-img-wrap::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 50%;
    height: 100%;
    background: linear-gradient(
        to right,
        rgba(255,255,255,0) 0%,
        rgba(255,255,255,0.25) 50%,
        rgba(255,255,255,0) 100%
    );
    transform: skewX(-25deg);
    transition: none;
}

.vet-card:hover .vet-img-wrap::after {
    left: 150%;
    transition: left 1s ease-in-out;
}

.vet-btn i {
    transition: transform 0.3s ease;
}

.vet-btn:hover i {
    transform: translateX(4px);
}

/* Micro-animations for services */
.service-item {
    transition: background-color 0.5s ease, transform 0.5s ease !important;
}

.service-item:hover {
    transform: translateY(-5px);
}

.service-item .service-arrow i {
    transition: transform 0.3s ease;
}

.service-item:hover .service-arrow i {
    transform: translateX(4px);
}

/* Micro-animations for process step dot */
@keyframes pulseGlow {
    0% {
        box-shadow: 0 0 0 0 rgba(201, 169, 89, 0.4);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(201, 169, 89, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(201, 169, 89, 0);
    }
}

.step-dot {
    animation: pulseGlow 2.5s infinite;
}

.step-item:hover .step-dot {
    animation: none;
    transform: scale(1.1);
    box-shadow: 0 0 15px var(--gold);
}

/* ═══════════════════════════════════════
   DESKTOP SPLIT SCREEN — min-width: 1101px
   ═══════════════════════════════════════ */
@media (min-width: 1101px) {
    .hero {
        background: #111;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        min-height: 100svh;
    }

    .hero-bg {
        left: 49.5%;
        right: 0;
        width: 50.5%;
        background-position: center;
        background-size: cover;
    }

    .hero-overlay {
        left: 49.5%;
        right: 0;
        width: 50.5%;
        background: linear-gradient(
            to right,
            #111 0%,
            rgba(17,17,17,0.75) 35%,
            rgba(17,17,17,0.15) 100%
        );
    }

    .hero-content {
        width: 50%;
        grid-template-columns: 1fr;
        padding: 4rem 4rem 4rem 5rem;
        gap: 3rem;
        align-items: flex-start;
        text-align: left;
    }

    .hero-title {
        font-size: clamp(3.5rem, 5vw, 5.2rem);
        line-height: 1.05;
        margin-bottom: 0;
    }

    .hero-side {
        align-items: flex-start;
        min-width: auto;
        padding-bottom: 0;
        width: 100%;
        gap: 1.75rem;
    }

    .hero-tagline {
        text-align: left;
        border-top: none;
        border-bottom: none;
        padding-top: 0;
        padding-bottom: 0;
        width: 100%;
        max-width: 320px;
    }

    .hero-actions {
        flex-direction: row;
        width: auto;
        gap: 1rem;
    }

    /* Scroll indicator responsive removed */
}

/* ═══════════════════════════════════════
   RESPONSIVE — tablet landscape  ≤ 1100px
   ═══════════════════════════════════════ */
@media (max-width: 1100px) {
    .container { padding: 0 2rem; }

    /* Hero */
    .hero-content {
        grid-template-columns: 1fr;
        padding: 0 2.5rem 4.5rem;
        gap: 2.5rem;
    }
    .hero-side { align-items: flex-start; min-width: auto; }
    .hero-tagline { text-align: left; }
    .hero-actions { flex-direction: row; width: auto; }

    /* Services intro 2-col → 1-col */
    .services-intro { grid-template-columns: 1fr !important; gap: 1.5rem !important; }

    /* Collection */
    .collection-grid { grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }

    /* Process 4 → 2×2 */
    .process-grid { grid-template-columns: repeat(2, 1fr); gap: 3.5rem 2rem; }
    .process-grid::after { display: none; }

    /* Testimonials 3 → 2 col */
    .testi-grid { grid-template-columns: repeat(2, 1fr); }

    /* Contact responsive removed */
}

/* ═══════════════════════════════════════
   RESPONSIVE — tablet portrait  ≤ 768px
   ═══════════════════════════════════════ */
@media (max-width: 768px) {
    .container { padding: 0 1.25rem; }
    .section { padding: 5rem 0; }

    /* Hero — FIX IMAGE MOBILE */
    .hero {
        min-height: 100svh;
        min-height: -webkit-fill-available;
    }
    .hero-bg {
        background-size: cover;
        background-position: 75% center; /* Décale vers le mannequin à droite */
        transform: scale(1) !important;
    }
    .hero:hover .hero-bg {
        transform: scale(1) !important;
    }

    .hero-content {
        grid-template-columns: 1fr;
        padding: 0 1.5rem 4rem;
        gap: 2rem;
    }
    .hero-title { font-size: clamp(3.8rem, 12vw, 6rem); letter-spacing: -0.5px; }
    .hero-year { margin-bottom: 1.25rem; }
    .hero-actions { flex-direction: column; gap: 0.75rem; width: 100%; max-width: 280px; }
    /* Scroll indicator display none removed */

    /* Stats — 2×2 */
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .stat-item { padding: 2rem 1.25rem; }
    .stat-num { font-size: 2.8rem; }

    /* Services — 1 col stacked */
    .services-grid { grid-template-columns: 1fr; }
    .service-item { padding: 2.5rem 1.75rem; }
    .service-num { font-size: 3rem; margin-bottom: 1rem; }

    /* Section heading intro */
    .section-heading { font-size: clamp(1.8rem, 6vw, 2.8rem); }

    /* Collection — 1 col */
    .collection-grid { grid-template-columns: 1fr; gap: 1.5rem; }
    .collection-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
    .vet-img-wrap { aspect-ratio: 4/3; }

    /* Process — 2×2 */
    .process-grid { grid-template-columns: repeat(2, 1fr); gap: 3rem 1rem; }

    /* Testimonials — 1 col */
    .testi-grid { grid-template-columns: 1fr; gap: 1.5rem; }
    .testi-card { padding: 2rem; }

    /* Contact responsive removed */

    /* Marquee — slow down slightly */
    .marquee-inner { animation-duration: 16s; }
}

/* ═══════════════════════════════════════
   RESPONSIVE — mobile  ≤ 480px
   ═══════════════════════════════════════ */
@media (max-width: 480px) {
    .container { padding: 0 1rem; }
    .section { padding: 4rem 0; }

    /* Hero — compact + FIX IMAGE */
    .hero {
        min-height: 100svh;
        min-height: -webkit-fill-available;
        align-items: flex-end;
    }
    .hero-bg {
        background-size: cover;
        background-position: 75% center; /* Décale vers le mannequin à droite */
        transform: scale(1) !important;
    }
    .hero:hover .hero-bg {
        transform: scale(1) !important;
    }
    .hero-content { padding: 0 1rem 3rem; gap: 1.5rem; }
    .hero-title { font-size: clamp(2.8rem, 15vw, 4.5rem); line-height: 1; }
    .hero-year { font-size: 0.6rem; letter-spacing: 3px; margin-bottom: 1rem; }
    .hero-tagline { display: none; }
    .hero-actions { max-width: 100%; }
    .btn-gold, .btn-outline-gold { padding: 0.85rem 1.5rem; font-size: 0.7rem; }

    /* Stats — 2×2 tight */
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .stat-item { padding: 1.5rem 0.75rem; }
    .stat-num { font-size: 2.2rem; }
    .stat-lbl { font-size: 0.6rem; letter-spacing: 1.5px; }

    /* Services */
    .service-item { padding: 2rem 1.25rem; }
    .service-num { font-size: 2.5rem; }
    .service-title { font-size: 1.2rem; }
    .service-desc { font-size: 0.82rem; }

    /* Section heading */
    .section-heading { font-size: clamp(1.6rem, 8vw, 2.2rem); }

    /* Collection */
    .collection-grid { grid-template-columns: 1fr; gap: 1.25rem; }
    .vet-img-wrap { aspect-ratio: 3/2; }
    .vet-body { padding: 1.25rem; }

    /* Process — 1 col on very small screens */
    .process-grid { grid-template-columns: 1fr; gap: 2.5rem; }
    .step-item { padding: 0 0.5rem; }

    /* Testimonials */
    .testi-card { padding: 1.5rem; }
    .testi-text { font-size: 1rem; }
    .testi-quote { font-size: 2.5rem; }

    /* Contact responsive removed */
}

/* ── Actions Row on Card ── */
.vet-actions-row {
    display: flex;
    gap: 0.5rem;
    margin-top: auto;
}

.vet-btn-detail {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.85rem 1rem;
    background: transparent;
    color: var(--charcoal);
    font-size: 0.68rem;
    font-weight: 500;
    letter-spacing: 2px;
    text-transform: uppercase;
    text-decoration: none;
    border: 1px solid var(--gold);
    transition: var(--transition);
    cursor: pointer;
}

.vet-btn-detail:hover {
    background: var(--charcoal);
    border-color: var(--charcoal);
    color: var(--gold-light);
}

/* Override welcome page's flex behavior for WhatsApp button to split evenly */
.vet-body .vet-btn-wa {
    flex: 1;
    justify-content: center;
    gap: 0.5rem;
}

/* ── Modal Premium Couture ── */
.modal-content {
    border: 1px solid rgba(201,169,89,0.2);
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 24px 60px rgba(0,0,0,0.25);
    background: #fdfcf9; /* Teinte ivoire douce */
}

.modal-body {
    padding: 0;
}

/* ── Image & Carousel section ── */
.modal-carousel-panel {
    background: #f4f0e6;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 1.5rem;
    border-right: 1px solid rgba(201,169,89,0.15);
}

.modal-carousel {
    width: 100%;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    border: 1px solid rgba(201,169,89,0.15);
}

.carousel-img-wrap {
    aspect-ratio: 3/4;
    position: relative;
    background: #fdfcf9;
}

.carousel-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
    transition: transform 0.6s ease;
}

.modal-carousel .carousel-control-prev,
.modal-carousel .carousel-control-next {
    width: 12%;
    opacity: 0;
    transition: opacity 0.3s;
}

.modal-carousel:hover .carousel-control-prev,
.modal-carousel:hover .carousel-control-next {
    opacity: 1;
}

.modal-carousel .carousel-control-prev-icon,
.modal-carousel .carousel-control-next-icon {
    background-color: rgba(26, 26, 26, 0.7);
    border-radius: 50%;
    padding: 1rem;
    background-size: 40%;
    border: 1px solid rgba(201,169,89,0.3);
}

/* Vignettes Interactives (Thumbnails) */
.thumbnail-btn {
    width: 60px;
    height: 80px;
    padding: 0;
    border: 1.5px solid var(--gray-300);
    border-radius: 8px;
    overflow: hidden;
    background: transparent;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    cursor: pointer;
}

.thumbnail-btn img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
}

.thumbnail-btn:hover {
    border-color: var(--primary);
    transform: translateY(-2px);
}

.thumbnail-btn.active {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(201,169,89,0.35);
    transform: translateY(-2px);
}

/* ── Info Panel ── */
.modal-info {
    padding: 3rem 2.5rem;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    max-height: 85vh;
    overflow-y: auto;
}

.modal-meta-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
}

.modal-cat-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    background: rgba(201,169,89,0.1);
    border: 1px solid rgba(201,169,89,0.25);
    color: var(--gold-dark);
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 0.35rem 0.85rem;
    border-radius: 999px;
}

.modal-status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.2);
    color: #065f46;
    font-size: 0.68rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 0.3rem 0.75rem;
    border-radius: 999px;
}

.modal-status-badge.indispo {
    background: rgba(239, 68, 68, 0.1);
    border-color: rgba(239, 68, 68, 0.2);
    color: #991b1b;
}

.modal-vet-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2.2rem;
    font-weight: 400;
    color: var(--charcoal);
    margin: 0 0 1rem;
    line-height: 1.15;
}

/* ── Price Block Couture ── */
.modal-price-box {
    background: rgba(201,169,89,0.05);
    border: 1.5px solid rgba(201,169,89,0.25);
    border-radius: 12px;
    padding: 0.8rem 1.2rem;
    width: fit-content;
    margin-bottom: 1.5rem;
}

.modal-price-box-val {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.8rem;
    font-weight: 600;
    color: var(--gold-dark);
    line-height: 1;
    display: flex;
    align-items: baseline;
    gap: 0.35rem;
}

.modal-price-box-val .cfa {
    font-family: 'Lato', sans-serif;
    font-size: 0.95rem;
    font-weight: 700;
}

.modal-divider {
    height: 1px;
    background: linear-gradient(to right, rgba(201,169,89,0.25), rgba(201,169,89,0.05));
    margin: 1.5rem 0;
    width: 100%;
}

.modal-desc-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.15rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--charcoal-mid);
    margin-bottom: 0.5rem;
}

.modal-desc {
    font-size: 0.88rem;
    color: var(--warm-gray);
    line-height: 1.75;
    margin-bottom: 1.5rem;
}

/* ── Fiche Technique Grid ── */
.specs-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
    margin-bottom: 1.75rem;
}

.spec-item {
    display: flex;
    gap: 0.75rem;
    align-items: flex-start;
    padding: 0.8rem;
    background: #fcfbfa;
    border-radius: 12px;
    border: 1px solid rgba(201,169,89,0.15);
    transition: transform 0.3s ease;
}

.spec-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
}

.spec-item i {
    font-size: 1.1rem;
    color: var(--primary);
    margin-top: 0.1rem;
}

.spec-item-label {
    font-size: 0.65rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--gray-500);
    font-weight: 600;
    margin-bottom: 0.15rem;
    line-height: 1;
}

.spec-item-value {
    font-size: 0.82rem;
    font-weight: 500;
    color: var(--charcoal-mid);
    line-height: 1.3;
}

/* ── Timeline ── */
.process-timeline {
    display: flex;
    justify-content: space-between;
    position: relative;
    margin: 2rem 0;
    padding: 0.5rem 0 1rem;
}

.process-timeline::before {
    content: '';
    position: absolute;
    top: 21px;
    left: 10%;
    right: 10%;
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(201,169,89,0.35) 20%, rgba(201,169,89,0.35) 80%, transparent);
    z-index: 1;
}

.timeline-step {
    position: relative;
    z-index: 2;
    text-align: center;
    width: 22%;
}

.timeline-dot {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: 1px solid var(--primary);
    background: #fdfcf9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Cormorant Garamond', serif;
    font-size: 0.9rem;
    color: var(--primary);
    margin: 0 auto 0.5rem;
    font-weight: 600;
    transition: all 0.3s;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.timeline-step:hover .timeline-dot {
    background: var(--primary);
    color: #fff;
    transform: scale(1.1);
    box-shadow: 0 0 8px rgba(201,169,89,0.4);
}

.timeline-lbl {
    font-size: 0.65rem;
    color: var(--gray-600);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    line-height: 1.2;
}

/* ── Boutons d'Action Premium ── */
.modal-actions-container {
    display: flex;
    gap: 0.75rem;
    align-items: center;
    flex-wrap: wrap;
    margin-top: 1.5rem;
}

.btn-modal-reserve-premium {
    flex-grow: 1;
    background: linear-gradient(135deg, var(--charcoal), var(--charcoal-mid));
    color: var(--gold-light) !important;
    border: 1.5px solid var(--gold);
    border-radius: 8px;
    padding: 0.85rem 1.75rem;
    font-family: 'Jost', sans-serif;
    font-size: 0.75rem;
    font-weight: 500;
    letter-spacing: 2px;
    text-transform: uppercase;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    text-decoration: none;
    box-shadow: 0 4px 14px rgba(0,0,0,0.15);
}

.btn-modal-reserve-premium:hover {
    background: var(--gold);
    color: var(--charcoal) !important;
    border-color: var(--gold);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(201,169,89,0.35);
}

.btn-modal-whatsapp {
    background: transparent;
    color: #25d366 !important;
    border: 1.5px solid #25d366;
    border-radius: 8px;
    padding: 0.85rem 1.5rem;
    font-family: 'Jost', sans-serif;
    font-size: 0.75rem;
    font-weight: 500;
    letter-spacing: 2px;
    text-transform: uppercase;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    text-decoration: none;
}

.btn-modal-whatsapp:hover {
    background: #25d366;
    color: #fff !important;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(37, 211, 102, 0.25);
}

.modal-disclaimer {
    font-size: 0.72rem;
    color: var(--gray-500);
    margin-top: 1rem;
    display: block;
    line-height: 1.4;
}

.modal-close-btn {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #fdfcf9;
    border: 1px solid rgba(201,169,89,0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 100;
    transition: all 0.3s;
    font-size: 0.9rem;
    color: var(--dark);
}

.modal-close-btn:hover {
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
    transform: rotate(90deg);
}

@media (max-width: 991px) {
    .modal-carousel-panel {
        border-right: none;
        border-bottom: 1px solid rgba(201,169,89,0.15);
    }
    .modal-info {
        padding: 2rem 1.5rem;
        max-height: none;
        overflow-y: visible;
    }
}

@media (max-width: 576px) {
    .specs-grid { grid-template-columns: 1fr; }
    .process-timeline::before { display: none; }
    .process-timeline { flex-direction: column; gap: 1rem; align-items: flex-start; margin: 1.5rem 0; }
    .timeline-step { width: 100%; display: flex; align-items: center; gap: 1rem; text-align: left; }
    .timeline-dot { margin: 0; }
}
</style>
@endsection

@section('content')

{{-- ─── HERO ─── --}}
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>

    <div class="hero-content">
        <div>
            <div class="hero-year">
                <span>Maison fondée en 2020</span>
            </div>
            <h1 class="hero-title">
                L'art de la<br>
                <em>couture</em><br>
                sur mesure
            </h1>
        </div>
        <div class="hero-side">
            <div class="hero-tagline">
                SMC Couture<br>
                Dakar, Sénégal
            </div>
            <div class="hero-actions">
                <a href="{{ route('vetements.index') }}" class="btn-gold">
                    <i class="fas fa-th-large" style="font-size:0.65rem;"></i>
                    Découvrir
                </a>
                <a href="{{ route('rendezvous.create') }}" class="btn-outline-gold" style="border-color:rgba(255,255,255,0.25); color:#fff;">
                    <i class="fas fa-calendar-check" style="font-size:0.65rem;"></i>
                    Rendez-vous
                </a>
            </div>
        </div>
    </div>


</section>

{{-- ─── MARQUEE ─── --}}
<div class="marquee-strip" aria-hidden="true">
    <div class="marquee-inner">
        <span>Vêtements Sur Mesure</span>
        <span>Artisanat d'exception</span>
        <span>Prise de mesures</span>
        <span>Tissus premium</span>
        <span>Créations uniques</span>
        <span>Dakar, Sénégal</span>
        <span>Vêtements Sur Mesure</span>
        <span>Artisanat d'exception</span>
        <span>Prise de mesures</span>
        <span>Tissus premium</span>
        <span>Créations uniques</span>
        <span>Dakar, Sénégal</span>
    </div>
</div>

{{-- ─── COLLECTION ─── --}}
@if($vetements->count() > 0)
<section id="collection-section" class="section section-warm">
    <div class="container">
        <div class="collection-header">
            <div data-reveal="fade-up">
                <div class="label-row">
                    <span class="label-line"></span>
                    <span class="section-label">Collection</span>
                </div>
                <h2 class="section-heading">Nos créations <em>récentes</em></h2>
            </div>
            <a href="{{ route('vetements.index') }}" class="btn-outline-gold" data-reveal="fade-up" data-delay="100">
                Voir tout <i class="fas fa-arrow-right" style="font-size:0.6rem;"></i>
            </a>
        </div>
        <div class="collection-grid">
            @foreach($vetements as $vetement)
            <div class="vet-card" data-reveal="fade-up" data-delay="{{ $loop->index * 100 }}">
                <div class="vet-img-wrap">
                    @php
                        $_src = $vetement->imageUrl;
                        $_src = $_src && !str_starts_with($_src, 'http') ? \Illuminate\Support\Facades\Storage::url($_src) : ($_src ?: 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=800');
                    @endphp
                    <img src="{{ $_src }}"
                         alt="{{ $vetement->nom }}"
                         onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1445205170230-053b83016050?w=800';">
                    @if($vetement->categorie)
                        <span class="vet-cat">{{ $vetement->categorie->nom }}</span>
                    @endif
                </div>
                <div class="vet-body">
                    <div class="vet-info-row">
                        <h4 class="vet-name">{{ $vetement->nom }}</h4>
                        <span class="vet-price-tag">{{ number_format($vetement->prix, 0, ',', ' ') }} CFA</span>
                    </div>
                    <p class="vet-desc">{{ \Illuminate\Support\Str::limit($vetement->description ?? '', 90) }}</p>
                    
                    <div class="vet-actions-row">
                        <button class="vet-btn-detail"
                                data-bs-toggle="modal"
                                data-bs-target="#vetementModal{{ $vetement->id }}">
                            <i class="fas fa-eye"></i> Détails
                        </button>
                        @php
                            $adminPhone = \App\Models\Admin::first()?->telephone ?? '221771234567';
                            $waPhone = preg_replace('/\D+/', '', $adminPhone);
                            if (strlen($waPhone) === 9 && (str_starts_with($waPhone, '77') || str_starts_with($waPhone, '78') || str_starts_with($waPhone, '76') || str_starts_with($waPhone, '70') || str_starts_with($waPhone, '75'))) {
                                $waPhone = '221' . $waPhone;
                            }
                            $_src = $vetement->imageUrl;
                            $_src = $_src && !str_starts_with($_src, 'http') ? \Illuminate\Support\Facades\Storage::url($_src) : ($_src ?: 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=800');
                            $absoluteImgUrl = url($_src);
                        @endphp
                        <a href="https://wa.me/{{ $waPhone }}?text=Bonjour%20SMC%20Couture,%20je%20souhaite%20commander%20le%20mod%C3%A8le%20{{ urlencode($vetement->nom) }}%20(Prix%20:%20{{ number_format($vetement->prix, 0, ',', ' ') }}%20CFA).%20Voici%20la%20photo%20:%20{{ urlencode($absoluteImgUrl) }}"
                           target="_blank"
                           class="vet-btn-wa">
                            <span>Commander</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 448 512" fill="currentColor">
                                <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Modal --}}
            <div class="modal fade" id="vetementModal{{ $vetement->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">

                        <div class="row g-0">
                            {{-- Image Carousel & Thumbnails Panel --}}
                            <div class="col-lg-6 col-md-6 modal-carousel-panel">
                                <div id="carousel-{{ $vetement->id }}" class="carousel slide" data-bs-ride="false">
                                    <div class="carousel-inner">
                                        @php
                                            $allImages = $vetement->images->sortBy('ordre');
                                            $allModalImages = $allImages->count() > 0 ? $allImages : collect([
                                                (object)['image_url' => 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=1200']
                                            ]);
                                            $fallbackUrl = 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=800';
                                        @endphp
                                        @foreach($allModalImages as $index => $img)
                                        @php
                                            $imgSrc = str_starts_with($img->image_url, 'http') ? $img->image_url : \Illuminate\Support\Facades\Storage::url($img->image_url);
                                        @endphp
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <div class="carousel-img-wrap rounded-4 overflow-hidden">
                                                <img src="{{ $imgSrc }}"
                                                     alt="{{ $vetement->nom }} - Image {{ $index + 1 }}"
                                                     onerror="this.onerror=null;this.src='{{ $fallbackUrl }}';">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    @if($allModalImages->count() > 1)
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $vetement->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Précédent</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $vetement->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Suivant</span>
                                    </button>
                                    @endif
                                </div>

                                {{-- Vignettes Interactives --}}
                                @if($allModalImages->count() > 1)
                                <div class="d-flex justify-content-center gap-2 mt-3 px-2 flex-wrap">
                                    @foreach($allModalImages as $thumbIndex => $img)
                                    @php
                                        $thumbSrc = str_starts_with($img->image_url, 'http') ? $img->image_url : \Illuminate\Support\Facades\Storage::url($img->image_url);
                                    @endphp
                                    <button type="button" 
                                            data-bs-target="#carousel-{{ $vetement->id }}" 
                                            data-bs-slide-to="{{ $thumbIndex }}" 
                                            class="thumbnail-btn {{ $thumbIndex === 0 ? 'active' : '' }}" 
                                            aria-label="Image {{ $thumbIndex + 1 }}">
                                        <img src="{{ $thumbSrc }}" alt="Vignette {{ $thumbIndex + 1 }}" onerror="this.onerror=null;this.src='{{ $fallbackUrl }}';">
                                    </button>
                                    @endforeach
                                </div>
                                @endif
                            </div>

                            {{-- Info --}}
                            <div class="col-lg-6 col-md-6 modal-info position-relative">
                                <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                                    <i class="fas fa-times"></i>
                                </button>

                                <h3 class="modal-vet-name" style="margin-bottom: 0.5rem; padding-right: 2rem;">{{ $vetement->nom }}</h3>

                                <div class="modal-meta-row" style="justify-content: flex-start; gap: 0.5rem; margin-bottom: 1.5rem;">
                                    @if($vetement->categorie)
                                        <span class="modal-cat-badge">
                                            <i class="fas fa-tag fa-xs"></i> {{ $vetement->categorie->nom }}
                                        </span>
                                    @endif
                                    @if($vetement->disponible)
                                        <span class="modal-status-badge">
                                            <i class="fas fa-check-circle fa-xs"></i> Disponible
                                        </span>
                                    @else
                                        <span class="modal-status-badge indispo">
                                            <i class="fas fa-times-circle fa-xs"></i> Sur commande
                                        </span>
                                    @endif
                                </div>

                                <h4 class="modal-desc-title">Description du modèle</h4>
                                <p class="modal-desc" style="margin-bottom: 1.5rem;">{{ $vetement->description ?: 'Aucune description disponible pour ce modèle de création artisanale.' }}</p>

                                <div class="modal-divider" style="margin: 1rem 0 1.5rem;"></div>

                                <h4 class="modal-desc-title">Caractéristiques</h4>
                                <div class="specs-grid">
                                    <div class="spec-item">
                                        <i class="fas fa-coins"></i>
                                        <div>
                                            <div class="spec-item-label">Tarif estimé</div>
                                            <div class="spec-item-value">{{ number_format($vetement->prix, 0, ',', ' ') }} CFA</div>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <div>
                                            <div class="spec-item-label">Création</div>
                                            <div class="spec-item-value">Dakar, Sénégal</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-divider" style="margin: 1.5rem 0;"></div>

                                <h4 class="modal-desc-title" style="font-size: 0.95rem; margin-bottom: 0.25rem;">Votre parcours couture</h4>
                                <div class="process-timeline">
                                    <div class="timeline-step">
                                        <div class="timeline-dot">I</div>
                                        <div class="timeline-lbl">Mesures</div>
                                    </div>
                                    <div class="timeline-step">
                                        <div class="timeline-dot">II</div>
                                        <div class="timeline-lbl">Tissus</div>
                                    </div>
                                    <div class="timeline-step">
                                        <div class="timeline-dot">III</div>
                                        <div class="timeline-lbl">Confection</div>
                                    </div>
                                    <div class="timeline-step">
                                        <div class="timeline-dot">IV</div>
                                        <div class="timeline-lbl">Essayage</div>
                                    </div>
                                </div>

                                <div class="modal-actions-container">
                                    @if($vetement->disponible)
                                        <a href="{{ route('rendezvous.create') }}?vetement={{ $vetement->id }}"
                                           class="btn-modal-reserve-premium">
                                            <i class="fas fa-calendar-plus"></i> Prendre RDV Mesures
                                        </a>
                                    @endif
                                </div>
                                <span class="modal-disclaimer">* La prise de rendez-vous est gratuite. Elle comprend une séance de mesures et d'écoute personnalisée à notre atelier.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ─── STATS ─── --}}
<section id="stats" class="section" style="background: #ffffff; padding-bottom: 0;">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item" data-reveal="fade-up" data-delay="0">
                <span class="stat-icon-sm"></span>
                <div class="stat-num" data-count="500" data-suffix="+">0</div>
                <div class="stat-lbl">Rendez-vous honorés</div>
            </div>
            <div class="stat-item" data-reveal="fade-up" data-delay="100">
                <span class="stat-icon-sm"></span>
                <div class="stat-num" data-count="200" data-suffix="+">0</div>
                <div class="stat-lbl">Créations réalisées</div>
            </div>
            <div class="stat-item" data-reveal="fade-up" data-delay="200">
                <span class="stat-icon-sm"></span>
                <div class="stat-num" data-count="150" data-suffix="+">0</div>
                <div class="stat-lbl">Clients satisfaits</div>
            </div>
            <div class="stat-item" data-reveal="fade-up" data-delay="300">
                <span class="stat-icon-sm"></span>
                <div class="stat-num" data-count="4" data-suffix="">0</div>
                <div class="stat-lbl">Années d'expertise</div>
            </div>
        </div>
    </div>
</section>

{{-- ─── SERVICES ─── --}}
<section class="section" style="background: #ffffff;">
    <div class="container">
        <div class="services-intro">
            <div data-reveal="fade-up">
                <div class="label-row">
                    <span class="label-line"></span>
                    <span class="section-label">Savoir-faire</span>
                </div>
                <h2 class="section-heading">Un atelier <em>d'exception</em></h2>
            </div>
            <p class="section-body" style="padding-top: 1.5rem;" data-reveal="fade-up" data-delay="100">
                De la conception à la réalisation, chaque détail est soigneusement pensé. Nos artisans mettent tout leur talent au service de votre élégance.
            </p>
        </div>
        <div class="services-grid">
            <div class="service-item" data-reveal="fade-up" data-delay="0">
                <div class="service-num">01</div>
                <h3 class="service-title">Vêtements Sur Mesure</h3>
                <p class="service-desc">Des pièces uniques adaptées à votre morphologie et à votre style, avec les plus beaux tissus soigneusement sélectionnés.</p>
                <div class="service-arrow">Découvrir <i class="fas fa-arrow-right" style="font-size:0.6rem;"></i></div>
            </div>
            <div class="service-item" data-reveal="fade-up" data-delay="100">
                <div class="service-num">02</div>
                <h3 class="service-title">Réservation en Ligne</h3>
                <p class="service-desc">Planifiez facilement vos rendez-vous de prise de mesures et d'essayage depuis le confort de votre maison.</p>
                <div class="service-arrow">Réserver <i class="fas fa-arrow-right" style="font-size:0.6rem;"></i></div>
            </div>
            <div class="service-item" data-reveal="fade-up" data-delay="200">
                <div class="service-num">03</div>
                <h3 class="service-title">Notifications WhatsApp</h3>
                <p class="service-desc">Recevez toutes vos confirmations et mises à jour de rendez-vous directement par WhatsApp en temps réel.</p>
                <div class="service-arrow">Prendre RDV <i class="fas fa-arrow-right" style="font-size:0.6rem;"></i></div>
            </div>
        </div>
    </div>
</section>

{{-- ─── PROCESS ─── --}}
<section class="section section-alt">
    <div class="container">
        <div style="text-align: center; margin-bottom: 5rem;" data-reveal="fade-up">
            <div class="label-row" style="justify-content: center;">
                <span class="label-line"></span>
                <span class="section-label">Comment ça marche</span>
                <span class="label-line"></span>
            </div>
            <h2 class="section-heading" style="margin-top: 1.25rem;">Votre expérience <em>couture</em></h2>
        </div>
        <div class="process-grid">
            <div class="step-item" data-reveal="fade-up" data-delay="0">
                <div class="step-dot">I</div>
                <h4 class="step-name">Inscrivez-vous</h4>
                <p class="step-desc">Créez votre compte client en quelques clics, simplement et rapidement.</p>
            </div>
            <div class="step-item" data-reveal="fade-up" data-delay="100">
                <div class="step-dot">II</div>
                <h4 class="step-name">Choisissez</h4>
                <p class="step-desc">Parcourez notre collection et sélectionnez le modèle qui vous inspire.</p>
            </div>
            <div class="step-item" data-reveal="fade-up" data-delay="200">
                <div class="step-dot">III</div>
                <h4 class="step-name">Réservez</h4>
                <p class="step-desc">Prenez rendez-vous pour la prise de mesures à votre convenance.</p>
            </div>
            <div class="step-item" data-reveal="fade-up" data-delay="300">
                <div class="step-dot">IV</div>
                <h4 class="step-name">Sublimez</h4>
                <p class="step-desc">Recevez votre création unique et arborez votre style avec élégance.</p>
            </div>
        </div>
    </div>
</section>




@endsection

@section('scripts')
<script>


function animateCounter(el) {
    const target = parseInt(el.getAttribute('data-count'), 10);
    if (isNaN(target)) return;
    const suffix = el.getAttribute('data-suffix') || '';
    const duration = 2000; // 2 seconds
    const startTime = performance.now();
    
    function update(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        // Easing function (easeOutQuad)
        const ease = progress * (2 - progress);
        const currentValue = Math.floor(ease * target);
        
        el.textContent = currentValue + suffix;
        
        if (progress < 1) {
            requestAnimationFrame(update);
        } else {
            el.textContent = target + suffix;
        }
    }
    
    requestAnimationFrame(update);
}

const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            const delay = entry.target.getAttribute('data-delay') || '0';
            setTimeout(() => {
                entry.target.classList.add('revealed');
                
                // Animate stats counters if present
                const counters = entry.target.querySelectorAll('.stat-num[data-count]');
                counters.forEach(counter => {
                    if (!counter.classList.contains('counted')) {
                        counter.classList.add('counted');
                        animateCounter(counter);
                    }
                });
                
                // If the element itself is a counter
                if (entry.target.classList.contains('stat-num') && entry.target.hasAttribute('data-count')) {
                    if (!entry.target.classList.contains('counted')) {
                        entry.target.classList.add('counted');
                        animateCounter(entry.target);
                    }
                }
            }, parseInt(delay, 10));
            revealObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.05, rootMargin: '0px 0px -50px 0px' });

document.querySelectorAll('[data-reveal]').forEach(el => revealObserver.observe(el));

// ── Carousel Thumbnail Synchronization ──
document.addEventListener('DOMContentLoaded', function () {
    var carousels = document.querySelectorAll('.modal-carousel-panel .carousel');
    carousels.forEach(function (carousel) {
        carousel.addEventListener('slide.bs.carousel', function (e) {
            var activeIndex = e.to;
            var panel = carousel.closest('.modal-carousel-panel');
            if (panel) {
                var thumbnails = panel.querySelectorAll('.thumbnail-btn');
                thumbnails.forEach(function (btn, index) {
                    if (index === activeIndex) {
                        btn.classList.add('active');
                        btn.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'nearest' });
                    } else {
                        btn.classList.remove('active');
                    }
                });
            }
        });
    });
});
</script>
@endsection