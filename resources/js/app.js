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

const projectShowcase = document.querySelector('[data-project-showcase]');

if (projectShowcase) {
    const projectCards = [...projectShowcase.querySelectorAll('[data-project-card]')];
    const projectCategory = projectShowcase.querySelector('[data-project-category]');
    const projectTitle = projectShowcase.querySelector('[data-project-title]');
    const projectDescription = projectShowcase.querySelector('[data-project-description]');
    const projectStack = projectShowcase.querySelector('[data-project-stack]');
    const projectCounter = projectShowcase.querySelector('[data-project-counter]');
    const projectStatus = projectShowcase.querySelector('[data-project-status]');
    const previousProjectButton = projectShowcase.querySelector('[data-project-previous]');
    const nextProjectButton = projectShowcase.querySelector('[data-project-next]');
    const totalProjects = projectCards.length;
    let activeProjectIndex = 0;

    const padProjectNumber = (value) => String(value).padStart(2, '0');

    const getProjectPosition = (cardIndex) => {
        let position = cardIndex - activeProjectIndex;

        if (position > totalProjects / 2) {
            position -= totalProjects;
        }

        if (position < -totalProjects / 2) {
            position += totalProjects;
        }

        return position;
    };

    const renderProject = (index, announce = true) => {
        if (totalProjects === 0) {
            return;
        }

        activeProjectIndex = (index + totalProjects) % totalProjects;

        projectCards.forEach((card, cardIndex) => {
            const position = getProjectPosition(cardIndex);
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

        const activeCard = projectCards[activeProjectIndex];

        if (projectCategory) {
            projectCategory.textContent = activeCard.dataset.category ?? '';
        }

        if (projectTitle) {
            projectTitle.textContent = activeCard.dataset.title ?? '';
        }

        if (projectDescription) {
            projectDescription.textContent = activeCard.dataset.description ?? '';
        }

        if (projectStack) {
            projectStack.textContent = activeCard.dataset.stack ?? '';
        }

        if (projectCounter) {
            projectCounter.textContent = `${padProjectNumber(activeProjectIndex + 1)} / ${padProjectNumber(totalProjects)}`;
        }

        if (announce && projectStatus) {
            projectStatus.textContent = `Menampilkan proyek ${activeCard.dataset.title}`;
        }
    };

    const focusProject = (index) => {
        renderProject(index);
        projectCards[activeProjectIndex]?.focus();
    };

    projectCards.forEach((card, index) => {
        card.addEventListener('click', () => renderProject(index));

        card.addEventListener('focus', () => {
            if (index !== activeProjectIndex) {
                renderProject(index);
            }
        });

        card.addEventListener('keydown', (event) => {
            const keyTargets = {
                ArrowRight: activeProjectIndex + 1,
                ArrowLeft: activeProjectIndex - 1,
                Home: 0,
                End: totalProjects - 1,
            };
            const targetIndex = keyTargets[event.key];

            if (targetIndex === undefined) {
                return;
            }

            event.preventDefault();
            focusProject(targetIndex);
        });
    });

    previousProjectButton?.addEventListener('click', () => renderProject(activeProjectIndex - 1));
    nextProjectButton?.addEventListener('click', () => renderProject(activeProjectIndex + 1));

    renderProject(activeProjectIndex, false);
}

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

const skillShowcase = document.querySelector('[data-skill-showcase]');
const skillTabs = [...document.querySelectorAll('[data-skill-tab]')];
const skillPanels = [...document.querySelectorAll('[data-skill-panel]')];
const skillCount = skillShowcase?.querySelector('[data-skill-count]');
const skillStatus = skillShowcase?.querySelector('[data-skill-status]');
const skillProgress = skillShowcase?.querySelector('[data-skill-progress]');
const previousSkillButton = skillShowcase?.querySelector('[data-skill-previous]');
const nextSkillButton = skillShowcase?.querySelector('[data-skill-next]');
const skillRotationInterval = 5000;

if (skillShowcase && skillTabs.length === skillPanels.length && skillTabs.length > 0) {
    let activeSkillIndex = 0;
    let isSkillPinned = false;
    let skillRotationTimer = null;

    const renderSkill = (index) => {
        activeSkillIndex = index;

        skillTabs.forEach((tab, tabIndex) => {
            const isActive = tabIndex === activeSkillIndex;
            tab.classList.toggle('is-active', isActive);
            tab.setAttribute('aria-selected', String(isActive));
            tab.setAttribute('tabindex', isActive ? '0' : '-1');
        });

        skillPanels.forEach((panel, panelIndex) => {
            panel.toggleAttribute('hidden', panelIndex !== activeSkillIndex);
        });

        if (skillCount) {
            const current = String(activeSkillIndex + 1).padStart(2, '0');
            const total = String(skillTabs.length).padStart(2, '0');
            skillCount.textContent = `${current} / ${total}`;
        }
    };

    const stopSkillRotation = () => {
        window.clearTimeout(skillRotationTimer);
        skillRotationTimer = null;
        skillProgress?.classList.remove('is-running');
    };

    const updateSkillStatus = () => {
        skillShowcase.toggleAttribute('data-pinned', isSkillPinned);

        if (!skillStatus) {
            return;
        }

        if (!allowsMotion) {
            skillStatus.textContent = 'Rotasi otomatis dinonaktifkan';
            return;
        }

        skillStatus.textContent = isSkillPinned
            ? 'Terkunci · klik ulang untuk melepas'
            : 'Rotasi otomatis · 5 detik';
    };

    const restartSkillProgress = () => {
        if (!skillProgress || !allowsMotion || isSkillPinned) {
            return;
        }

        skillProgress.classList.remove('is-running');
        void skillProgress.offsetWidth;
        skillProgress.classList.add('is-running');
    };

    const scheduleSkillRotation = () => {
        stopSkillRotation();

        if (!allowsMotion || isSkillPinned || document.hidden) {
            return;
        }

        restartSkillProgress();
        skillRotationTimer = window.setTimeout(() => {
            renderSkill((activeSkillIndex + 1) % skillTabs.length);
            scheduleSkillRotation();
        }, skillRotationInterval);
    };

    const pinSkill = (index) => {
        renderSkill(index);
        isSkillPinned = true;
        updateSkillStatus();
        stopSkillRotation();
    };

    skillTabs.forEach((tab, index) => {
        tab.addEventListener('click', () => {
            if (index === activeSkillIndex && isSkillPinned) {
                isSkillPinned = false;
                updateSkillStatus();
                scheduleSkillRotation();
                return;
            }

            pinSkill(index);
        });

        tab.addEventListener('keydown', (event) => {
            const keyTargets = {
                ArrowRight: (index + 1) % skillTabs.length,
                ArrowDown: (index + 1) % skillTabs.length,
                ArrowLeft: (index - 1 + skillTabs.length) % skillTabs.length,
                ArrowUp: (index - 1 + skillTabs.length) % skillTabs.length,
                Home: 0,
                End: skillTabs.length - 1,
            };
            const targetIndex = keyTargets[event.key];

            if (targetIndex === undefined) {
                return;
            }

            event.preventDefault();
            skillTabs[targetIndex].focus();
            pinSkill(targetIndex);
        });
    });

    previousSkillButton?.addEventListener('click', () => {
        pinSkill((activeSkillIndex - 1 + skillTabs.length) % skillTabs.length);
    });

    nextSkillButton?.addEventListener('click', () => {
        pinSkill((activeSkillIndex + 1) % skillTabs.length);
    });

    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            stopSkillRotation();
            return;
        }

        scheduleSkillRotation();
    });

    renderSkill(activeSkillIndex);
    updateSkillStatus();
    scheduleSkillRotation();
}

const sections = [...document.querySelectorAll('main section[id]')];
const navLinks = [...document.querySelectorAll('[data-nav-link]')];
const sectionObserver = new IntersectionObserver((entries) => {
    const visibleSection = entries.filter((entry) => entry.isIntersecting).sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0];
    if (!visibleSection) return;
    navLinks.forEach((link) => link.classList.toggle('is-current', link.getAttribute('href') === `#${visibleSection.target.id}`));
}, { rootMargin: '-35% 0px -55%', threshold: [0, 0.25, 0.5] });

sections.forEach((section) => sectionObserver.observe(section));
