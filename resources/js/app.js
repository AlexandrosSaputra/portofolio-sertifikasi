const menuButton = document.querySelector('[data-menu-button]');
const mobileMenu = document.querySelector('[data-mobile-menu]');

menuButton?.addEventListener('click', () => {
    const isOpen = menuButton.getAttribute('aria-expanded') === 'true';
    menuButton.setAttribute('aria-expanded', String(!isOpen));
    menuButton.setAttribute('aria-label', isOpen ? 'Buka menu' : 'Tutup menu');
    mobileMenu?.classList.toggle('hidden');
});

document.querySelectorAll('[data-nav-link]').forEach((link) => {
    link.addEventListener('click', () => {
        menuButton?.setAttribute('aria-expanded', 'false');
        mobileMenu?.classList.add('hidden');
    });
});

const filters = document.querySelectorAll('[data-filter]');
const projectCards = document.querySelectorAll('[data-project]');

filters.forEach((button) => {
    button.addEventListener('click', () => {
        const filter = button.dataset.filter;
        filters.forEach((item) => {
            item.classList.remove('is-active');
            item.setAttribute('aria-pressed', 'false');
        });
        button.classList.add('is-active');
        button.setAttribute('aria-pressed', 'true');
        projectCards.forEach((card) => {
            const visible = filter === 'all' || card.dataset.category === filter;
            card.toggleAttribute('hidden', !visible);
        });
    });
});

const revealElements = [...document.querySelectorAll('[data-reveal]')];

revealElements.forEach((element, index) => {
    element.style.setProperty('--reveal-delay', `${(index % 4) * 90}ms`);
});

if ('IntersectionObserver' in window) {
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.14 });

    revealElements.forEach((element) => revealObserver.observe(element));
} else {
    revealElements.forEach((element) => element.classList.add('is-visible'));
}

const profileFrame = document.querySelector('[data-profile-card]');
const profileCard = document.querySelector('[data-profile-card-content]');
const allowsMotion = !window.matchMedia('(prefers-reduced-motion: reduce)').matches;

if (profileFrame && profileCard && allowsMotion) {
    profileFrame.addEventListener('pointermove', (event) => {
        const bounds = profileFrame.getBoundingClientRect();
        const pointerX = (event.clientX - bounds.left) / bounds.width;
        const pointerY = (event.clientY - bounds.top) / bounds.height;

        profileCard.style.setProperty('--rotate-x', `${(0.5 - pointerY) * 8}deg`);
        profileCard.style.setProperty('--rotate-y', `${(pointerX - 0.5) * 10}deg`);
        profileCard.style.setProperty('--pointer-x', `${pointerX * 100}%`);
        profileCard.style.setProperty('--pointer-y', `${pointerY * 100}%`);
    });

    profileFrame.addEventListener('pointerleave', () => {
        profileCard.style.setProperty('--rotate-x', '0deg');
        profileCard.style.setProperty('--rotate-y', '0deg');
        profileCard.style.setProperty('--pointer-x', '50%');
        profileCard.style.setProperty('--pointer-y', '50%');
    });
}

const sections = [...document.querySelectorAll('main section[id]')];
const navLinks = [...document.querySelectorAll('[data-nav-link]')];
const sectionObserver = new IntersectionObserver((entries) => {
    const visibleSection = entries.filter((entry) => entry.isIntersecting).sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0];
    if (!visibleSection) return;
    navLinks.forEach((link) => link.classList.toggle('is-current', link.getAttribute('href') === `#${visibleSection.target.id}`));
}, { rootMargin: '-35% 0px -55%', threshold: [0, 0.25, 0.5] });

sections.forEach((section) => sectionObserver.observe(section));
