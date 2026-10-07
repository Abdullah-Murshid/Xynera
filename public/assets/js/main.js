/* ═══════════════════════════════════════════
   XYNERA — Main JavaScript (Global Form)
   main.js
═══════════════════════════════════════════ */

document.addEventListener('DOMContentLoaded', () => {

    /* ── Theme Management (Sync with Admin) ── */
    const initTheme = () => {
        const savedTheme = localStorage.getItem('theme');
        // Default to dark if nothing saved, otherwise apply light-mode if 'light'
        if (savedTheme === 'light') {
            document.body.classList.add('light-mode');
        } else {
            document.body.classList.remove('light-mode');
        }
    };
    initTheme();

    /* ── Mobile Menu Logic & Overlay ── */
    const hamburger = document.querySelector('.hamburger');
    const mobileMenu = document.getElementById('mobile-menu');
    let overlay = document.querySelector('.mobile-overlay');

    // Create overlay if it doesn't exist
    if (!overlay && mobileMenu) {
        overlay = document.createElement('div');
        overlay.classList.add('mobile-overlay');
        document.body.appendChild(overlay);
    }

    if (hamburger && mobileMenu && overlay) {
        const toggleMenu = () => {
            const isOpen = mobileMenu.classList.contains('open');
            if (isOpen) {
                // Close menu
                mobileMenu.classList.remove('open');
                overlay.classList.remove('active');
                document.body.style.overflow = ''; // Restore scrolling
            } else {
                // Open menu
                mobileMenu.classList.add('open');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden'; // Prevent scrolling
            }
        };

        hamburger.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', toggleMenu); // Click overlay to close
    }

    /* ── Global Scroll Watcher (Intersection Observer) ── */
    const reveals = document.querySelectorAll('.reveal');
    if (reveals.length > 0) {
        // High performance single observer
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    // Stop observing once animated
                    observer.unobserve(entry.target);
                }
            });
        }, {
            root: null,
            rootMargin: '0px',
            threshold: 0.12
        });

        reveals.forEach(el => revealObserver.observe(el));
    }

    /* ── Glassmorphism Header State ── */
    const header = document.querySelector('header');
    if (header) {
        const handleScroll = () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        };

        // Check initial state
        handleScroll();

        // Passive scroll listener for max FPS
        window.addEventListener('scroll', handleScroll, { passive: true });
    }

    /* ── Passive Resize Listener Example (General utility) ── */
    window.addEventListener('resize', () => {
        // Handle global resize tracking if ever needed here, e.g. closing mobile menu on desktop flip
        if (window.innerWidth >= 768 && mobileMenu && mobileMenu.classList.contains('open')) {
            mobileMenu.classList.remove('open');
            if(overlay) overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    }, { passive: true });

});