import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {

    // ── Smooth scroll ────────────────────────────────────────────────────────
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            const id = anchor.getAttribute('href').slice(1);
            const el = document.getElementById(id);
            if (el) {
                e.preventDefault();
                el.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // ── Hero entrance animations (immediate, no scroll needed) ───────────────
    document.querySelectorAll('[data-hero]').forEach((el, i) => {
        const delay = parseFloat(el.dataset.delay || 0);
        el.style.animationDelay = delay + 's';
        el.classList.add('hero-animate');
    });

    // ── Scroll-triggered animations (whileInView equivalent) ─────────────────
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    document.querySelectorAll('[data-animate]').forEach(el => {
        observer.observe(el);
    });

    // ── Stagger children of [data-stagger] ───────────────────────────────────
    document.querySelectorAll('[data-stagger]').forEach(parent => {
        const step = parseFloat(parent.dataset.stagger || 0.1);
        parent.querySelectorAll(':scope > *').forEach((child, i) => {
            child.dataset.animate = child.dataset.animate || 'fade-up';
            child.style.transitionDelay = (i * step) + 's';
            observer.observe(child);
        });
    });

    // ── Mobile nav close on link ──────────────────────────────────────────────
    document.querySelectorAll('#mobile-menu a').forEach(a => {
        a.addEventListener('click', () => {
            document.getElementById('mobile-menu')?.classList.add('hidden');
        });
    });

    // ── Navbar background on scroll ──────────────────────────────────────────
    const navbar = document.querySelector('nav');
    if (navbar) {
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 20);
        }, { passive: true });
    }
});
