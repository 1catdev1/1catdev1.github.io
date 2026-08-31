/**
 * RollzSMP — Main JavaScript
 */

(function () {
    'use strict';

    // ==================== CURSOR GLOW ====================
    const glow = document.getElementById('cursorGlow');
    let mouseX = 0, mouseY = 0;
    let glowX = 0, glowY = 0;
    let rafId = null;
    let isVisible = false;

    const isTouchDevice = () =>
        window.matchMedia('(hover: none), (pointer: coarse)').matches;

    function updateGlow() {
        glowX += (mouseX - glowX) * 0.12;
        glowY += (mouseY - glowY) * 0.12;
        if (glow) {
            glow.style.transform = `translate(${glowX}px, ${glowY}px) translate(-50%, -50%)`;
        }
        rafId = requestAnimationFrame(updateGlow);
    }

    if (glow && !isTouchDevice()) {
        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            if (!isVisible) {
                isVisible = true;
                glow.classList.add('visible');
                rafId = requestAnimationFrame(updateGlow);
            }
        });

        document.addEventListener('mouseleave', () => {
            isVisible = false;
            glow.classList.remove('visible');
            if (rafId) cancelAnimationFrame(rafId);
        });
    }

    // ==================== NAVBAR SCROLL ====================
    const navbar = document.getElementById('navbar');
    let lastScroll = 0;

    function onScroll() {
        const y = window.scrollY;
        if (navbar) {
            if (y > 40) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }
        lastScroll = y;
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // ==================== MOBILE MENU ====================
    const hamburger = document.getElementById('hamburger');
    const nav = document.getElementById('navbarNav');

    if (hamburger && nav) {
        hamburger.addEventListener('click', () => {
            const open = nav.classList.toggle('open');
            hamburger.classList.toggle('active', open);
            hamburger.setAttribute('aria-expanded', open ? 'true' : 'false');
            document.body.style.overflow = open ? 'hidden' : '';
        });

        nav.querySelectorAll('.nav-link').forEach((link) => {
            link.addEventListener('click', () => {
                nav.classList.remove('open');
                hamburger.classList.remove('active');
                hamburger.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            });
        });
    }

    // ==================== COPY IP ====================
    document.querySelectorAll('[data-copy]').forEach((btn) => {
        btn.addEventListener('click', async () => {
            const text = btn.getAttribute('data-copy');
            if (!text) return;

            try {
                await navigator.clipboard.writeText(text);
                const original = btn.textContent;
                btn.classList.add('copied');
                btn.textContent = 'Скопировано!';
                setTimeout(() => {
                    btn.classList.remove('copied');
                    btn.textContent = original;
                }, 2000);
            } catch {
                // Fallback
                const ta = document.createElement('textarea');
                ta.value = text;
                ta.style.position = 'fixed';
                ta.style.opacity = '0';
                document.body.appendChild(ta);
                ta.select();
                document.execCommand('copy');
                document.body.removeChild(ta);
                const original = btn.textContent;
                btn.classList.add('copied');
                btn.textContent = 'Скопировано!';
                setTimeout(() => {
                    btn.classList.remove('copied');
                    btn.textContent = original;
                }, 2000);
            }
        });
    });

    // ==================== SERVER STATUS ====================
    const statusContainers = document.querySelectorAll('[data-server-status]');
    if (statusContainers.length === 0) return;

    let lastUpdateTime = Date.now();
    let pollInterval = null;
    let currentData = null;

    function formatAgo(seconds) {
        if (seconds < 5) return 'Обновлено только что';
        if (seconds < 60) return `Обновлено ${seconds} сек. назад`;
        const m = Math.floor(seconds / 60);
        return `Обновлено ${m} мин. назад`;
    }

    function animateNumber(el, from, to) {
        if (from === to) {
            el.textContent = to;
            return;
        }
        const duration = 400;
        const start = performance.now();
        const diff = to - from;

        function step(now) {
            const t = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - t, 3);
            el.textContent = Math.round(from + diff * eased);
            if (t < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    }

    function renderStatus(data, container) {
        const onlineEl = container.querySelector('[data-status-online]');
        const playersEl = container.querySelector('[data-status-players]');
        const maxEl = container.querySelector('[data-status-max]');
        const progressEl = container.querySelector('[data-status-progress]');
        const versionEl = container.querySelector('[data-status-version]');
        const latencyEl = container.querySelector('[data-status-latency]');
        const updatedEl = container.querySelector('[data-status-updated]');
        const loadingEl = container.querySelector('[data-status-loading]');
        const errorEl = container.querySelector('[data-status-error]');
        const contentEl = container.querySelector('[data-status-content]');

        if (loadingEl) loadingEl.style.display = 'none';
        if (errorEl) errorEl.style.display = 'none';
        if (contentEl) contentEl.style.display = '';

        if (data.error === 'disabled') {
            if (onlineEl) {
                onlineEl.innerHTML = '<span class="status-dot unknown"></span> НЕДОСТУПЕН';
            }
            if (playersEl) playersEl.textContent = '—';
            if (maxEl) maxEl.textContent = '—';
            return;
        }

        const isOnline = data.online === true;
        const isUnknown = data.online === null || data.online === undefined;

        if (onlineEl) {
            if (isOnline) {
                onlineEl.innerHTML = '<span class="status-dot online"></span> ONLINE';
            } else if (isUnknown) {
                onlineEl.innerHTML = '<span class="status-dot unknown"></span> UNKNOWN';
            } else {
                onlineEl.innerHTML = '<span class="status-dot offline"></span> OFFLINE';
            }
        }

        const players = data.players ?? 0;
        const max = data.max_players ?? 0;

        if (playersEl) {
            const prev = currentData ? (currentData.players ?? 0) : players;
            if (prev !== players && currentData) {
                animateNumber(playersEl, prev, players);
            } else {
                playersEl.textContent = players;
            }
        }
        if (maxEl) maxEl.textContent = max;

        if (progressEl) {
            const pct = max > 0 ? Math.min(100, (players / max) * 100) : 0;
            progressEl.style.width = pct + '%';
        }

        if (versionEl && data.version) {
            versionEl.textContent = data.version;
            versionEl.style.display = '';
        } else if (versionEl) {
            versionEl.style.display = 'none';
        }

        if (latencyEl) {
            if (data.latency != null) {
                latencyEl.textContent = data.latency + ' ms';
                latencyEl.parentElement.style.display = '';
            } else {
                latencyEl.parentElement.style.display = 'none';
            }
        }

        lastUpdateTime = Date.now();
        if (updatedEl) {
            updatedEl.textContent = formatAgo(0);
        }

        currentData = data;
    }

    function showLoading(container) {
        const loadingEl = container.querySelector('[data-status-loading]');
        const contentEl = container.querySelector('[data-status-content]');
        const errorEl = container.querySelector('[data-status-error]');
        if (loadingEl) loadingEl.style.display = '';
        if (contentEl) contentEl.style.display = 'none';
        if (errorEl) errorEl.style.display = 'none';
    }

    function showError(container) {
        const loadingEl = container.querySelector('[data-status-loading]');
        const contentEl = container.querySelector('[data-status-content]');
        const errorEl = container.querySelector('[data-status-error]');
        if (loadingEl) loadingEl.style.display = 'none';
        if (contentEl) contentEl.style.display = 'none';
        if (errorEl) errorEl.style.display = '';
    }

    async function fetchStatus() {
        try {
            const res = await fetch('/api/server-status.php', {
                headers: { Accept: 'application/json' },
                cache: 'no-store',
            });
            if (!res.ok) throw new Error('HTTP ' + res.status);
            const data = await res.json();
            statusContainers.forEach((c) => renderStatus(data, c));
        } catch {
            statusContainers.forEach((c) => showError(c));
        }
    }

    // Initial load
    statusContainers.forEach(showLoading);
    fetchStatus();

    // Poll every 20 seconds
    pollInterval = setInterval(fetchStatus, 1500);

    // Update "ago" text every second
    setInterval(() => {
        statusContainers.forEach((container) => {
            const el = container.querySelector('[data-status-updated]');
            if (el && currentData) {
                const sec = Math.floor((Date.now() - lastUpdateTime) / 1000);
                el.textContent = formatAgo(sec);
            }
        });
    }, 1000);

    // Retry buttons
    document.querySelectorAll('[data-status-retry]').forEach((btn) => {
        btn.addEventListener('click', () => {
            statusContainers.forEach(showLoading);
            fetchStatus();
        });
    });

    // Clean up on page hide
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            if (pollInterval) clearInterval(pollInterval);
        } else {
            fetchStatus();
            pollInterval = setInterval(fetchStatus, 1500);
        }
    });
})();
