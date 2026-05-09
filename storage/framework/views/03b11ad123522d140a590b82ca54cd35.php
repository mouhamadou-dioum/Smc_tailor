<?php $__env->startSection('title', 'Accueil — SMC Couture'); ?>

<?php $__env->startSection('styles'); ?>
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
    background: url("<?php echo e(asset('heros2.png')); ?>") center/cover no-repeat;
    transform: scale(1.04);
    transition: transform 14s ease-in-out;
}

.hero:hover .hero-bg { transform: scale(1); }

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

.hero-year::before {
    content: '';
    display: block;
    width: 40px;
    height: 1px;
    background: var(--gold);
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
    display: block;
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
    border-top: 1px solid rgba(201,169,89,0.25);
    padding-top: 1.25rem;
}

.hero-actions {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    width: 100%;
}

/* Scroll indicator */
.hero-scroll {
    position: absolute;
    bottom: 2.5rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    color: rgba(255,255,255,0.35);
    font-size: 0.6rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    text-decoration: none;
    z-index: 3;
}

.scroll-line {
    width: 1px;
    height: 48px;
    background: linear-gradient(to bottom, var(--gold), transparent);
    animation: scrollDrop 2s ease-in-out infinite;
}

@keyframes scrollDrop {
    0%, 100% { opacity: 0.3; transform: scaleY(0.5); transform-origin: top; }
    50% { opacity: 1; transform: scaleY(1); }
}

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
.section { padding: 7rem 0; }
.section-alt { background: var(--charcoal); }
.section-warm { background: #F2EDE3; }

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
.section-alt .section-heading { color: #fff; }
.section-alt .section-heading em { color: var(--gold-light); }

.section-body {
    font-size: 0.95rem;
    font-weight: 300;
    color: var(--warm-gray);
    line-height: 1.85;
    max-width: 440px;
}
.section-alt .section-body { color: #9A9080; }

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

.service-item:hover .service-desc { color: #7A7060; }

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
    top: 1rem;
    left: 1rem;
    font-size: 0.6rem;
    font-weight: 500;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--charcoal);
    background: rgba(248,245,238,0.9);
    backdrop-filter: blur(4px);
    padding: 0.35rem 0.75rem;
}

.vet-price {
    position: absolute;
    bottom: 1rem;
    right: 1rem;
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.05rem;
    font-weight: 500;
    color: #fff;
    background: var(--charcoal);
    padding: 0.4rem 0.9rem;
}

.vet-body {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.vet-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.2rem;
    font-weight: 400;
    color: var(--charcoal);
    margin-bottom: 0.4rem;
}

.vet-desc {
    font-size: 0.8rem;
    font-weight: 300;
    color: var(--warm-gray);
    line-height: 1.7;
    flex: 1;
    margin-bottom: 1.25rem;
}

.vet-btn {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.75rem 1rem;
    background: var(--ivory);
    color: var(--charcoal);
    font-size: 0.65rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    text-decoration: none;
    border: 1px solid var(--border-gold);
    transition: var(--transition);
}

.vet-btn:hover { background: var(--charcoal); color: var(--gold-light); }

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
    background: var(--charcoal);
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
    color: var(--gold-light);
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

/* ─── CONTACT ─── */
.contact-wrap {
    display: grid;
    grid-template-columns: 5fr 7fr;
    gap: 0;
    border: 1px solid rgba(255,255,255,0.08);
}

.contact-info-side {
    padding: 5rem;
    border-right: 1px solid rgba(255,255,255,0.08);
}

.contact-detail {
    display: flex;
    align-items: flex-start;
    gap: 1.25rem;
    margin-bottom: 2rem;
}

.contact-icon {
    width: 36px;
    height: 36px;
    border: 1px solid var(--border-gold);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    color: var(--gold);
    flex-shrink: 0;
    margin-top: 0.15rem;
}

.contact-lbl {
    font-size: 0.62rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 0.3rem;
}

.contact-val {
    font-size: 0.88rem;
    font-weight: 300;
    color: #9A9080;
    text-decoration: none;
    transition: color 0.3s ease;
}

.contact-val:hover { color: var(--gold); }

.contact-form-side {
    padding: 5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.field-group { display: flex; flex-direction: column; gap: 0.5rem; }

.field-label {
    font-size: 0.62rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--gold);
}

.field-input,
.field-textarea {
    background: transparent;
    border: none;
    border-bottom: 1px solid rgba(255,255,255,0.12);
    color: #fff;
    font-family: 'Jost', sans-serif;
    font-size: 0.88rem;
    font-weight: 300;
    padding: 0.75rem 0;
    outline: none;
    transition: border-color 0.3s ease;
    width: 100%;
}

.field-input:focus, .field-textarea:focus { border-bottom-color: var(--gold); }
.field-textarea { resize: none; min-height: 100px; }

.submit-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 2.5rem;
    background: var(--gold);
    color: var(--charcoal);
    font-family: 'Jost', sans-serif;
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 2px;
    text-transform: uppercase;
    border: none;
    cursor: pointer;
    transition: var(--transition);
    margin-top: 1rem;
}

.submit-btn:hover { background: var(--gold-light); }

/* ─── ANIMATE IN ─── */
[data-reveal] {
    opacity: 0;
    transform: translateY(28px);
    transition: opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1), transform 0.75s cubic-bezier(0.16, 1, 0.3, 1);
}

[data-reveal].revealed { opacity: 1; transform: translateY(0); }

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

    /* Contact */
    .contact-wrap { grid-template-columns: 1fr; }
    .contact-info-side {
        border-right: none;
        border-bottom: 1px solid rgba(255,255,255,0.08);
        padding: 3.5rem 2.5rem;
    }
    .contact-form-side { padding: 3.5rem 2.5rem; }
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
    .hero-scroll { display: none; }

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

    /* Contact */
    .contact-info-side { padding: 3rem 1.5rem; }
    .contact-form-side { padding: 3rem 1.5rem; }
    .form-row { grid-template-columns: 1fr; gap: 1.25rem; }

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

    /* Contact */
    .contact-info-side { padding: 2.5rem 1rem; }
    .contact-form-side { padding: 2.5rem 1rem; }
    .submit-btn { width: 100%; justify-content: center; padding: 1rem; }
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>

    <div class="hero-content">
        <div>
            <div class="hero-year">
                <span>Maison fondée en 2020</span>
            </div>
            <h1 class="hero-title">
                L'art de<br>
                la <em>couture</em><br>
                sur mesure
            </h1>
        </div>
        <div class="hero-side">
            <div class="hero-tagline">
                SMC Couture<br>
                Dakar, Sénégal
            </div>
            <div class="hero-actions">
                <a href="<?php echo e(route('vetements.index')); ?>" class="btn-gold">
                    <i class="fas fa-th-large" style="font-size:0.65rem;"></i>
                    Découvrir
                </a>
                <a href="<?php echo e(route('register')); ?>" class="btn-outline-gold" style="border-color:rgba(255,255,255,0.25); color:#fff;">
                    <i class="fas fa-calendar-check" style="font-size:0.65rem;"></i>
                    Rendez-vous
                </a>
            </div>
        </div>
    </div>

    <a href="#stats" class="hero-scroll">
        <div class="scroll-line"></div>
        <span>Défiler</span>
    </a>
</section>


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


<section id="stats" class="section" style="background: var(--ivory); padding-bottom: 0;">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item" data-reveal>
                <span class="stat-icon-sm"></span>
                <div class="stat-num">500+</div>
                <div class="stat-lbl">Rendez-vous honorés</div>
            </div>
            <div class="stat-item" data-reveal>
                <span class="stat-icon-sm"></span>
                <div class="stat-num">200+</div>
                <div class="stat-lbl">Créations réalisées</div>
            </div>
            <div class="stat-item" data-reveal>
                <span class="stat-icon-sm"></span>
                <div class="stat-num">150+</div>
                <div class="stat-lbl">Clients satisfaits</div>
            </div>
            <div class="stat-item" data-reveal>
                <span class="stat-icon-sm"></span>
                <div class="stat-num">4</div>
                <div class="stat-lbl">Années d'expertise</div>
            </div>
        </div>
    </div>
</section>


<section class="section" style="background: var(--ivory);">
    <div class="container">
        <div class="services-intro">
            <div data-reveal>
                <div class="label-row">
                    <span class="label-line"></span>
                    <span class="section-label">Savoir-faire</span>
                </div>
                <h2 class="section-heading">Un atelier <em>d'exception</em></h2>
            </div>
            <p class="section-body" style="padding-top: 1.5rem;" data-reveal>
                De la conception à la réalisation, chaque détail est soigneusement pensé. Nos artisans mettent tout leur talent au service de votre élégance.
            </p>
        </div>
        <div class="services-grid" data-reveal>
            <div class="service-item">
                <div class="service-num">01</div>
                <h3 class="service-title">Vêtements Sur Mesure</h3>
                <p class="service-desc">Des pièces uniques adaptées à votre morphologie et à votre style, avec les plus beaux tissus soigneusement sélectionnés.</p>
                <div class="service-arrow">Découvrir <i class="fas fa-arrow-right" style="font-size:0.6rem;"></i></div>
            </div>
            <div class="service-item">
                <div class="service-num">02</div>
                <h3 class="service-title">Réservation en Ligne</h3>
                <p class="service-desc">Planifiez facilement vos rendez-vous de prise de mesures et d'essayage depuis le confort de votre maison.</p>
                <div class="service-arrow">Réserver <i class="fas fa-arrow-right" style="font-size:0.6rem;"></i></div>
            </div>
            <div class="service-item">
                <div class="service-num">03</div>
                <h3 class="service-title">Suivi & Notifications</h3>
                <p class="service-desc">Recevez toutes vos confirmations par email ou WhatsApp et suivez l'avancement de votre création en temps réel.</p>
                <div class="service-arrow">En savoir plus <i class="fas fa-arrow-right" style="font-size:0.6rem;"></i></div>
            </div>
        </div>
    </div>
</section>


<?php if($vetements->count() > 0): ?>
<section class="section section-warm">
    <div class="container">
        <div class="collection-header">
            <div data-reveal>
                <div class="label-row">
                    <span class="label-line"></span>
                    <span class="section-label">Collection</span>
                </div>
                <h2 class="section-heading">Nos créations <em>récentes</em></h2>
            </div>
            <a href="<?php echo e(route('vetements.index')); ?>" class="btn-outline-gold" data-reveal>
                Voir tout <i class="fas fa-arrow-right" style="font-size:0.6rem;"></i>
            </a>
        </div>
        <div class="collection-grid">
            <?php $__currentLoopData = $vetements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vetement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="vet-card" data-reveal>
                <div class="vet-img-wrap">
                    <img src="<?php echo e($vetement->imageUrl ?: 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=800'); ?>"
                         alt="<?php echo e($vetement->nom); ?>"
                         onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1445205170230-053b83016050?w=800';">
                    <?php if($vetement->categorie): ?>
                        <span class="vet-cat"><?php echo e($vetement->categorie->nom); ?></span>
                    <?php endif; ?>
                    <span class="vet-price"><?php echo e(number_format($vetement->prix, 0, ',', ' ')); ?> CFA</span>
                </div>
                <div class="vet-body">
                    <h4 class="vet-name"><?php echo e($vetement->nom); ?></h4>
                    <p class="vet-desc"><?php echo e(\Illuminate\Support\Str::limit($vetement->description ?? '', 90)); ?></p>
                    <a href="<?php echo e(route('rendezvous.create')); ?>?vetement=<?php echo e($vetement->id); ?>" class="vet-btn">
                        <span>Réserver ce modèle</span>
                        <i class="fas fa-arrow-right" style="font-size:0.6rem;"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>


<section class="section section-alt">
    <div class="container">
        <div style="text-align: center; margin-bottom: 5rem;" data-reveal>
            <div class="label-row" style="justify-content: center;">
                <span class="label-line"></span>
                <span class="section-label">Comment ça marche</span>
                <span class="label-line"></span>
            </div>
            <h2 class="section-heading" style="color: #fff; margin-top: 1.25rem;">Votre expérience <em>couture</em></h2>
        </div>
        <div class="process-grid" data-reveal>
            <div class="step-item">
                <div class="step-dot">I</div>
                <h4 class="step-name">Inscrivez-vous</h4>
                <p class="step-desc">Créez votre compte client en quelques clics, simplement et rapidement.</p>
            </div>
            <div class="step-item">
                <div class="step-dot">II</div>
                <h4 class="step-name">Choisissez</h4>
                <p class="step-desc">Parcourez notre collection et sélectionnez le modèle qui vous inspire.</p>
            </div>
            <div class="step-item">
                <div class="step-dot">III</div>
                <h4 class="step-name">Réservez</h4>
                <p class="step-desc">Prenez rendez-vous pour la prise de mesures à votre convenance.</p>
            </div>
            <div class="step-item">
                <div class="step-dot">IV</div>
                <h4 class="step-name">Sublimez</h4>
                <p class="step-desc">Recevez votre création unique et arborez votre style avec élégance.</p>
            </div>
        </div>
    </div>
</section>


<section class="section" style="background: var(--ivory);">
    <div class="container">
        <div style="margin-bottom: 4rem;" data-reveal>
            <div class="label-row">
                <span class="label-line"></span>
                <span class="section-label">Témoignages</span>
            </div>
            <h2 class="section-heading">La voix de nos <em>clients</em></h2>
        </div>
        <div class="testi-grid">
            <div class="testi-card" data-reveal>
                <div class="testi-quote">"</div>
                <div class="testi-stars">★★★★★</div>
                <p class="testi-text">Un travail d'une qualité exceptionnelle ! Le costume sur mesure taillé pour mon mariage était parfait. Merci pour votre professionnalisme.</p>
                <div class="testi-footer">
                    <img src="https://ui-avatars.com/api/?name=Aissatou+Diop&background=c9a959&color=1a1a1a&size=40" alt="" class="testi-avatar">
                    <div>
                        <div class="testi-name">Aïssatou Diop</div>
                        <div class="testi-role">Mariage 2024</div>
                    </div>
                </div>
            </div>
            <div class="testi-card" data-reveal>
                <div class="testi-quote">"</div>
                <div class="testi-stars">★★★★★</div>
                <p class="testi-text">Je recommande vivement SMC Couture ! La robe confectionnée est magnifique et les délais ont été respectés à la lettre.</p>
                <div class="testi-footer">
                    <img src="https://ui-avatars.com/api/?name=Marieme+Fall&background=c9a959&color=1a1a1a&size=40" alt="" class="testi-avatar">
                    <div>
                        <div class="testi-name">Marième Fall</div>
                        <div class="testi-role">Robe de cérémonie</div>
                    </div>
                </div>
            </div>
            <div class="testi-card" data-reveal>
                <div class="testi-quote">"</div>
                <div class="testi-stars">★★★★★</div>
                <p class="testi-text">La réservation en ligne est très pratique et le suivi WhatsApp est un vrai plus. Client fidèle depuis l'ouverture, jamais déçu !</p>
                <div class="testi-footer">
                    <img src="https://ui-avatars.com/api/?name=Oumar+Sy&background=c9a959&color=1a1a1a&size=40" alt="" class="testi-avatar">
                    <div>
                        <div class="testi-name">Oumar Sy</div>
                        <div class="testi-role">Client fidèle</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="section section-alt" style="padding: 0;">
    <div class="container" style="padding: 0; max-width: 100%;">
        <div class="contact-wrap">
            <div class="contact-info-side" data-reveal>
                <div class="label-row" style="margin-bottom: 2rem;">
                    <span class="label-line"></span>
                    <span class="section-label">Contact</span>
                </div>
                <h2 class="section-heading" style="margin-bottom: 1.5rem;">Parlons de<br><em>votre projet</em></h2>
                <p class="section-body" style="margin-bottom: 3rem;">
                    Une idée précise ou besoin de conseils ? Notre équipe est à votre écoute pour créer la pièce de vos rêves.
                </p>
                <div class="contact-detail">
                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <div class="contact-lbl">Adresse</div>
                        <div class="contact-val">Dakar, Sénégal</div>
                    </div>
                </div>
                <div class="contact-detail">
                    <div class="contact-icon"><i class="fas fa-phone"></i></div>
                    <div>
                        <div class="contact-lbl">Téléphone</div>
                        <a href="tel:+221771234567" class="contact-val">+221 77 123 45 67</a>
                    </div>
                </div>
                <div class="contact-detail">
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <div class="contact-lbl">Email</div>
                        <a href="mailto:contact@couture.com" class="contact-val">contact@couture.com</a>
                    </div>
                </div>
            </div>
            <div class="contact-form-side" data-reveal>
                <form id="contactForm">
                    <div class="form-row">
                        <div class="field-group">
                            <label class="field-label">Nom complet</label>
                            <input type="text" class="field-input" required>
                        </div>
                        <div class="field-group">
                            <label class="field-label">Email</label>
                            <input type="email" class="field-input" required>
                        </div>
                    </div>
                    <div class="field-group" style="margin-bottom: 1.5rem;">
                        <label class="field-label">Sujet</label>
                        <input type="text" class="field-input">
                    </div>
                    <div class="field-group" style="margin-bottom: 0;">
                        <label class="field-label">Message</label>
                        <textarea class="field-textarea" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-paper-plane" style="font-size:0.7rem;"></i>
                        Envoyer le message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
document.getElementById('contactForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Merci pour votre message ! Nous vous contacterons dans les plus brefs délais.');
    this.reset();
});

const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
            setTimeout(() => {
                entry.target.classList.add('revealed');
            }, 80);
            revealObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

document.querySelectorAll('[data-reveal]').forEach(el => revealObserver.observe(el));
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fallou\projet laravel\couture-app\resources\views/welcome.blade.php ENDPATH**/ ?>