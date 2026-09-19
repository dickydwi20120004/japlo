/**
 * JAPLO — Landing Page Scripts
 * File: public/js/welcome.js
 */

/* ─────────────────────────────────────────
   HERO SLIDER
───────────────────────────────────────── */
const HeroSlider = {
    slides:  null,
    dots:    null,
    current: 0,
    timer:   null,
    interval: 4000,

    init() {
        this.slides = document.querySelectorAll('.hero-slide');
        this.dots   = document.querySelectorAll('.hero-dots span');

        if (!this.slides.length) return;

        // Click on dots
        this.dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                clearInterval(this.timer);
                this.goTo(i);
                this.autoPlay();
            });
        });

        // Touch/swipe support
        let startX = 0;
        const banner = document.querySelector('.hero-banner-main');
        if (banner) {
            banner.addEventListener('touchstart', e => { startX = e.touches[0].clientX; }, { passive: true });
            banner.addEventListener('touchend', e => {
                const diff = startX - e.changedTouches[0].clientX;
                if (Math.abs(diff) > 50) {
                    clearInterval(this.timer);
                    this.goTo(this.current + (diff > 0 ? 1 : -1));
                    this.autoPlay();
                }
            });
        }

        this.autoPlay();
    },

    goTo(n) {
        this.slides[this.current].classList.remove('active');
        this.dots[this.current]?.classList.remove('active');
        this.current = ((n % this.slides.length) + this.slides.length) % this.slides.length;
        this.slides[this.current].classList.add('active');
        this.dots[this.current]?.classList.add('active');
    },

    autoPlay() {
        this.timer = setInterval(() => this.goTo(this.current + 1), this.interval);
    }
};

/* ─────────────────────────────────────────
   COUNTDOWN TIMER
───────────────────────────────────────── */
const Countdown = {
    elH: null,
    elM: null,
    elS: null,

    init() {
        this.elH = document.getElementById('hh');
        this.elM = document.getElementById('mm');
        this.elS = document.getElementById('ss');
        if (!this.elH) return;
        this.tick();
        setInterval(() => this.tick(), 1000);
    },

    tick() {
        const now  = new Date();
        const end  = new Date();
        end.setHours(23, 59, 59, 0);
        const diff = Math.max(0, end - now);
        const h    = Math.floor(diff / 3600000);
        const m    = Math.floor((diff % 3600000) / 60000);
        const s    = Math.floor((diff % 60000) / 1000);
        this.elH.textContent = String(h).padStart(2, '0');
        this.elM.textContent = String(m).padStart(2, '0');
        this.elS.textContent = String(s).padStart(2, '0');
    }
};

/* ─────────────────────────────────────────
   CATEGORY BAR — Aktifkan item sesuai path
───────────────────────────────────────── */
const CatBar = {
    init() {
        const path = window.location.pathname;
        document.querySelectorAll('.catbar li a').forEach(a => {
            a.classList.remove('active');
            if (a.getAttribute('href') === path) {
                a.classList.add('active');
            }
        });
    }
};

/* ─────────────────────────────────────────
   INIT
───────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', () => {
    HeroSlider.init();
    Countdown.init();
    CatBar.init();
});
