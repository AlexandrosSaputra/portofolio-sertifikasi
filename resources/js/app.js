/**
 * Interaksi halaman portofolio. Setiap fungsi keluar lebih awal jika elemen
 * penandanya tidak ada, sehingga partial section bisa dilepas tanpa error.
 */

const allowsMotion = !window.matchMedia('(prefers-reduced-motion: reduce)').matches;

/**
 * Menu mobile: tombol mengatur aria-expanded dan tautan navigasi menutup menu
 * setelah diklik agar section tujuan langsung terlihat.
 */
function initMobileMenu() {
    const menuButton = document.querySelector('[data-menu-button]');
    const mobileMenu = document.querySelector('[data-mobile-menu]');

    if (!menuButton || !mobileMenu) {
        return;
    }

    const setMenuOpen = (isOpen) => {
        menuButton.setAttribute('aria-expanded', String(isOpen));
        menuButton.setAttribute('aria-label', isOpen ? 'Tutup menu' : 'Buka menu');
        mobileMenu.classList.toggle('hidden', !isOpen);
    };

    menuButton.addEventListener('click', () => {
        setMenuOpen(menuButton.getAttribute('aria-expanded') !== 'true');
    });

    document.querySelectorAll('[data-nav-link]').forEach((link) => {
        link.addEventListener('click', () => setMenuOpen(false));
    });
}

/**
 * Galeri proyek berbentuk tumpukan kartu melingkar. Hanya tiga kartu terdekat
 * yang terlihat; kartu jauh dibuat inert dan aria-hidden agar tidak bisa
 * difokuskan atau dibacakan pembaca layar.
 */
function initProjectShowcase() {
    const showcase = document.querySelector('[data-project-showcase]');

    if (!showcase) {
        return;
    }

    const cards = [...showcase.querySelectorAll('[data-project-card]')];
    const category = showcase.querySelector('[data-project-category]');
    const title = showcase.querySelector('[data-project-title]');
    const description = showcase.querySelector('[data-project-description]');
    const stack = showcase.querySelector('[data-project-stack]');
    const counter = showcase.querySelector('[data-project-counter]');
    const status = showcase.querySelector('[data-project-status]');
    const previousButton = showcase.querySelector('[data-project-previous]');
    const nextButton = showcase.querySelector('[data-project-next]');
    const total = cards.length;
    let activeIndex = 0;

    if (total === 0) {
        return;
    }

    const pad = (value) => String(value).padStart(2, '0');

    /**
     * Posisi kartu relatif terhadap kartu aktif (-2 sampai 2). Kartu yang
     * melewati separuh daftar diputar ke sisi seberang supaya tumpukan kiri
     * dan kanan tetap seimbang.
     */
    const getCardPosition = (cardIndex) => {
        let position = cardIndex - activeIndex;

        if (position > total / 2) {
            position -= total;
        }

        if (position < -total / 2) {
            position += total;
        }

        return position;
    };

    /**
     * @param {number} index
     * @param {boolean} announce Menulis status ke live region; dimatikan saat
     *                           render awal agar pembaca layar tidak langsung
     *                           membacakan proyek pertama.
     */
    const render = (index, announce = true) => {
        activeIndex = (index + total) % total;

        cards.forEach((card, cardIndex) => {
            const position = getCardPosition(cardIndex);
            const isOffstage = Math.abs(position) > 2;
            const isActive = position === 0;

            card.dataset.position = String(position);
            card.style.setProperty('--position', String(position));
            card.classList.toggle('is-offstage', isOffstage);
            card.toggleAttribute('inert', isOffstage);

            if (isOffstage) {
                card.setAttribute('aria-hidden', 'true');
            } else {
                card.removeAttribute('aria-hidden');
            }

            if (isActive) {
                card.setAttribute('aria-current', 'true');
            } else {
                card.removeAttribute('aria-current');
            }
        });

        const activeCard = cards[activeIndex];

        if (category) {
            category.textContent = activeCard.dataset.category ?? '';
        }

        if (title) {
            title.textContent = activeCard.dataset.title ?? '';
        }

        if (description) {
            description.textContent = activeCard.dataset.description ?? '';
        }

        if (stack) {
            stack.textContent = activeCard.dataset.stack ?? '';
        }

        if (counter) {
            counter.textContent = `${pad(activeIndex + 1)} / ${pad(total)}`;
        }

        if (announce && status) {
            status.textContent = `Menampilkan proyek ${activeCard.dataset.title}`;
        }
    };

    const focusCard = (index) => {
        render(index);
        cards[activeIndex]?.focus();
    };

    cards.forEach((card, index) => {
        card.addEventListener('click', () => render(index));

        // Fokus keyboard ikut memindahkan kartu aktif agar detail tetap sinkron.
        card.addEventListener('focus', () => {
            if (index !== activeIndex) {
                render(index);
            }
        });

        card.addEventListener('keydown', (event) => {
            const targetByKey = {
                ArrowRight: activeIndex + 1,
                ArrowLeft: activeIndex - 1,
                Home: 0,
                End: total - 1,
            };
            const targetIndex = targetByKey[event.key];

            if (targetIndex === undefined) {
                return;
            }

            event.preventDefault();
            focusCard(targetIndex);
        });
    });

    previousButton?.addEventListener('click', () => render(activeIndex - 1));
    nextButton?.addEventListener('click', () => render(activeIndex + 1));

    render(activeIndex, false);
}

/**
 * Menampilkan elemen bertanda data-reveal saat masuk viewport. Elemen diberi
 * delay kecil bergiliran supaya kemunculannya terasa berurutan, dan langsung
 * ditampilkan jika IntersectionObserver tidak tersedia.
 */
function initRevealAnimations() {
    const elements = [...document.querySelectorAll('[data-reveal]')];

    if (elements.length === 0) {
        return;
    }

    elements.forEach((element, index) => {
        element.style.setProperty('--reveal-delay', `${(index % 4) * 90}ms`);
    });

    if (!('IntersectionObserver' in window)) {
        elements.forEach((element) => element.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.14 });

    elements.forEach((element) => observer.observe(element));
}

/**
 * Kemiringan kartu profil mengikuti posisi pointer. Efek ini dianggap
 * dekoratif, jadi tidak dijalankan saat pengunjung meminta reduced motion.
 */
function initProfileTilt() {
    const frame = document.querySelector('[data-profile-card]');
    const card = document.querySelector('[data-profile-card-content]');

    if (!frame || !card || !allowsMotion) {
        return;
    }

    frame.addEventListener('pointermove', (event) => {
        const bounds = frame.getBoundingClientRect();
        const pointerX = (event.clientX - bounds.left) / bounds.width;
        const pointerY = (event.clientY - bounds.top) / bounds.height;

        card.style.setProperty('--rotate-x', `${(0.5 - pointerY) * 8}deg`);
        card.style.setProperty('--rotate-y', `${(pointerX - 0.5) * 10}deg`);
        card.style.setProperty('--pointer-x', `${pointerX * 100}%`);
        card.style.setProperty('--pointer-y', `${pointerY * 100}%`);
    });

    frame.addEventListener('pointerleave', () => {
        card.style.setProperty('--rotate-x', '0deg');
        card.style.setProperty('--rotate-y', '0deg');
        card.style.setProperty('--pointer-x', '50%');
        card.style.setProperty('--pointer-y', '50%');
    });
}

/**
 * Rotasi bidang keahlian di section Tentang. Interaksi manual mengunci rotasi
 * agar panel tidak berpindah saat sedang dibaca; klik ulang melepas kunci.
 */
function initSkillShowcase() {
    const showcase = document.querySelector('[data-skill-showcase]');

    if (!showcase) {
        return;
    }

    const tabs = [...showcase.querySelectorAll('[data-skill-tab]')];
    const panels = [...showcase.querySelectorAll('[data-skill-panel]')];
    const count = showcase.querySelector('[data-skill-count]');
    const status = showcase.querySelector('[data-skill-status]');
    const progress = showcase.querySelector('[data-skill-progress]');
    const previousButton = showcase.querySelector('[data-skill-previous]');
    const nextButton = showcase.querySelector('[data-skill-next]');

    // Harus sama dengan durasi animasi .about-skill-progress pada app.css.
    const rotationInterval = 5000;

    if (tabs.length === 0 || tabs.length !== panels.length) {
        return;
    }

    let activeIndex = 0;
    let isPinned = false;
    let rotationTimer = null;

    const render = (index) => {
        activeIndex = index;

        tabs.forEach((tab, tabIndex) => {
            const isActive = tabIndex === activeIndex;
            tab.classList.toggle('is-active', isActive);
            tab.setAttribute('aria-selected', String(isActive));
            tab.setAttribute('tabindex', isActive ? '0' : '-1');
        });

        panels.forEach((panel, panelIndex) => {
            panel.toggleAttribute('hidden', panelIndex !== activeIndex);
        });

        if (count) {
            count.textContent = `${String(activeIndex + 1).padStart(2, '0')} / ${String(tabs.length).padStart(2, '0')}`;
        }
    };

    const stopRotation = () => {
        window.clearTimeout(rotationTimer);
        rotationTimer = null;
        progress?.classList.remove('is-running');
    };

    const updateStatus = () => {
        showcase.toggleAttribute('data-pinned', isPinned);

        if (!status) {
            return;
        }

        if (!allowsMotion) {
            status.textContent = 'Rotasi otomatis dinonaktifkan';
            return;
        }

        status.textContent = isPinned
            ? 'Terkunci · klik ulang untuk melepas'
            : 'Rotasi otomatis · 5 detik';
    };

    const restartProgress = () => {
        if (!progress || !allowsMotion || isPinned) {
            return;
        }

        // Memaksa reflow agar animasi progress dimulai lagi dari nol.
        progress.classList.remove('is-running');
        void progress.offsetWidth;
        progress.classList.add('is-running');
    };

    const scheduleRotation = () => {
        stopRotation();

        if (!allowsMotion || isPinned || document.hidden) {
            return;
        }

        restartProgress();
        rotationTimer = window.setTimeout(() => {
            render((activeIndex + 1) % tabs.length);
            scheduleRotation();
        }, rotationInterval);
    };

    const pin = (index) => {
        render(index);
        isPinned = true;
        updateStatus();
        stopRotation();
    };

    tabs.forEach((tab, index) => {
        tab.addEventListener('click', () => {
            if (index === activeIndex && isPinned) {
                isPinned = false;
                updateStatus();
                scheduleRotation();
                return;
            }

            pin(index);
        });

        tab.addEventListener('keydown', (event) => {
            const targetByKey = {
                ArrowRight: (index + 1) % tabs.length,
                ArrowDown: (index + 1) % tabs.length,
                ArrowLeft: (index - 1 + tabs.length) % tabs.length,
                ArrowUp: (index - 1 + tabs.length) % tabs.length,
                Home: 0,
                End: tabs.length - 1,
            };
            const targetIndex = targetByKey[event.key];

            if (targetIndex === undefined) {
                return;
            }

            event.preventDefault();
            tabs[targetIndex].focus();
            pin(targetIndex);
        });
    });

    previousButton?.addEventListener('click', () => {
        pin((activeIndex - 1 + tabs.length) % tabs.length);
    });

    nextButton?.addEventListener('click', () => {
        pin((activeIndex + 1) % tabs.length);
    });

    // Timer dihentikan saat tab tidak terlihat agar tidak berjalan di latar.
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            stopRotation();
            return;
        }

        scheduleRotation();
    });

    render(activeIndex);
    updateStatus();
    scheduleRotation();
}

/**
 * Menandai tautan navigasi yang cocok dengan section paling dominan di
 * viewport. rootMargin mempersempit pengamatan ke area tengah layar.
 */
function initActiveSectionHighlight() {
    const sections = [...document.querySelectorAll('main section[id]')];
    const navLinks = [...document.querySelectorAll('[data-nav-link]')];

    if (sections.length === 0 || navLinks.length === 0 || !('IntersectionObserver' in window)) {
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        const visibleSection = entries
            .filter((entry) => entry.isIntersecting)
            .sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0];

        if (!visibleSection) {
            return;
        }

        navLinks.forEach((link) => {
            link.classList.toggle('is-current', link.getAttribute('href') === `#${visibleSection.target.id}`);
        });
    }, { rootMargin: '-35% 0px -55%', threshold: [0, 0.25, 0.5] });

    sections.forEach((section) => observer.observe(section));
}

initMobileMenu();
initProjectShowcase();
initRevealAnimations();
initProfileTilt();
initSkillShowcase();
initActiveSectionHighlight();
