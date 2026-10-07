import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    /* ── Mobile Menu Logic ── */
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (hamburger && mobileMenu) {
        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('flex');
        });
    }

    /* ── Scroll Reveal Observer ── */
    const reveals = document.querySelectorAll('.reveal');
    if (reveals.length > 0) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        reveals.forEach(el => revealObserver.observe(el));
    }

    /* ── Header Scroll State ── */
    const header = document.getElementById('main-header');
    if (header) {
        window.addEventListener('scroll', () => {
            const isScrolled = window.scrollY > 50;
            header.classList.toggle('bg-agency-dark/95', isScrolled);
            header.classList.toggle('py-1', isScrolled);
            header.classList.toggle('bg-agency-dark/80', !isScrolled);
            header.classList.toggle('py-0', !isScrolled);
        }, { passive: true });
    }
});
