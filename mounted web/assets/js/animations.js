/**
 * RollzSMP — Scroll & entrance animations
 */

(function () {
    'use strict';

    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Hero entrance
    function initHero() {
        const items = document.querySelectorAll('.hero-animate');
        if (items.length === 0) return;

        if (prefersReduced) {
            items.forEach((el) => el.classList.add('visible'));
            return;
        }

        // Small delay so page paints first
        requestAnimationFrame(() => {
            setTimeout(() => {
                items.forEach((el) => el.classList.add('visible'));
            }, 80);
        });
    }

    // IntersectionObserver for scroll reveals
    function initReveal() {
        const elements = document.querySelectorAll(
            '.reveal, .reveal-left, .reveal-right, .reveal-scale'
        );
        if (elements.length === 0) return;

        if (prefersReduced) {
            elements.forEach((el) => el.classList.add('visible'));
            return;
        }

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            },
            {
                threshold: 0.12,
                rootMargin: '0px 0px -40px 0px',
            }
        );

        elements.forEach((el) => observer.observe(el));
    }

    // Light parallax for decorative elements
    function initParallax() {
        if (prefersReduced) return;

        const blobs = document.querySelectorAll('.bg-blob');
        if (blobs.length === 0) return;

        let ticking = false;

        window.addEventListener(
            'scroll',
            () => {
                if (ticking) return;
                ticking = true;
                requestAnimationFrame(() => {
                    const y = window.scrollY;
                    blobs.forEach((blob, i) => {
                        const speed = 0.03 + i * 0.015;
                        blob.style.transform = `translateY(${y * speed}px)`;
                    });
                    ticking = false;
                });
            },
            { passive: true }
        );
    }

    // Init
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            initHero();
            initReveal();
            initParallax();
        });
    } else {
        initHero();
        initReveal();
        initParallax();
    }
})();
