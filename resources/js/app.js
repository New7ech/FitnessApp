const menuToggle = document.querySelector('[data-menu-toggle]');
const mobileMenu = document.querySelector('[data-mobile-menu]');
const root = document.documentElement;
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

document.body.classList.add('js-ready');

const progressBar = document.createElement('div');
progressBar.className = 'scroll-progress';
progressBar.setAttribute('aria-hidden', 'true');
document.body.prepend(progressBar);

const updateScrollState = () => {
    const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
    const progress = maxScroll > 0 ? window.scrollY / maxScroll : 0;

    progressBar.style.transform = `scaleX(${progress})`;
    document.body.classList.toggle('is-scrolled', window.scrollY > 24);
    root.style.setProperty('--scroll-ratio', progress.toFixed(4));
};

updateScrollState();
window.addEventListener('scroll', updateScrollState, { passive: true });

if (menuToggle && mobileMenu) {
    const closeMenu = () => {
        mobileMenu.hidden = true;
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.setAttribute('aria-label', 'Ouvrir le menu');
    };

    menuToggle.addEventListener('click', () => {
        const isOpen = menuToggle.getAttribute('aria-expanded') === 'true';

        mobileMenu.hidden = isOpen;
        menuToggle.setAttribute('aria-expanded', String(!isOpen));
        menuToggle.setAttribute('aria-label', isOpen ? 'Ouvrir le menu' : 'Fermer le menu');
    });

    mobileMenu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', closeMenu);
    });
}

const heroSlides = Array.from(document.querySelectorAll('[data-hero-slide]'));
const heroDots = Array.from(document.querySelectorAll('[data-slide-dot]'));
const prevSlide = document.querySelector('[data-slide-prev]');
const nextSlide = document.querySelector('[data-slide-next]');
let activeSlide = heroSlides.findIndex((slide) => slide.classList.contains('active'));
let slideTimer = null;

if (heroSlides.length > 1) {
    activeSlide = activeSlide >= 0 ? activeSlide : 0;

    const showSlide = (index) => {
        activeSlide = (index + heroSlides.length) % heroSlides.length;

        heroSlides.forEach((slide, slideIndex) => {
            slide.classList.toggle('active', slideIndex === activeSlide);
        });

        heroDots.forEach((dot, dotIndex) => {
            dot.classList.toggle('active', dotIndex === activeSlide);
        });

        document.body.style.setProperty('--active-slide', activeSlide);
    };

    const scheduleSlider = () => {
        window.clearInterval(slideTimer);
        slideTimer = window.setInterval(() => showSlide(activeSlide + 1), 4500);
    };

    prevSlide?.addEventListener('click', () => {
        showSlide(activeSlide - 1);
        scheduleSlider();
    });

    nextSlide?.addEventListener('click', () => {
        showSlide(activeSlide + 1);
        scheduleSlider();
    });

    heroDots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showSlide(index);
            scheduleSlider();
        });
    });

    if (!prefersReducedMotion) {
        scheduleSlider();
    }
}

const revealTargets = [
    '.section-title',
    '.category-card',
    '.promo-tile',
    '.product-card',
    '.featured-strip',
    '.objective-card',
    '.mini-product',
    '.center-ad',
    '.article-grid article',
    '.request-copy',
    '.request-panel',
    '.request-steps span',
    '.logo-cloud span',
    '.movement-grid img',
    '.shop-footer > div',
    '.admin-heading',
    '.admin-stats article',
    '.admin-filters',
    '.admin-request-card',
    '.admin-login-panel',
];

const revealItems = document.querySelectorAll(revealTargets.join(','));

if ('IntersectionObserver' in window) {
    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        });
    }, {
        rootMargin: '0px 0px -10% 0px',
        threshold: 0.16,
    });

    revealItems.forEach((item, index) => {
        item.classList.add('reveal-item');
        item.style.setProperty('--reveal-delay', `${Math.min(index % 8, 7) * 55}ms`);
        revealObserver.observe(item);
    });
} else {
    revealItems.forEach((item) => item.classList.add('is-visible'));
}

const tiltCards = document.querySelectorAll('.product-card, .category-card, .promo-tile, .objective-card, .article-grid article');

if (!prefersReducedMotion) {
    tiltCards.forEach((card) => {
        card.addEventListener('pointermove', (event) => {
            const rect = card.getBoundingClientRect();
            const x = ((event.clientX - rect.left) / rect.width - 0.5) * 2;
            const y = ((event.clientY - rect.top) / rect.height - 0.5) * 2;

            card.style.setProperty('--tilt-x', `${(-y * 4).toFixed(2)}deg`);
            card.style.setProperty('--tilt-y', `${(x * 5).toFixed(2)}deg`);
            card.style.setProperty('--spot-x', `${event.clientX - rect.left}px`);
            card.style.setProperty('--spot-y', `${event.clientY - rect.top}px`);
            card.classList.add('is-tilting');
        });

        card.addEventListener('pointerleave', () => {
            card.classList.remove('is-tilting');
            card.style.removeProperty('--tilt-x');
            card.style.removeProperty('--tilt-y');
        });
    });
}

document.querySelectorAll('.button, .slider-cta, .category-nav a, .header-actions a, .icon-button, .product-action').forEach((element) => {
    element.addEventListener('click', (event) => {
        const ripple = document.createElement('span');
        const rect = element.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);

        ripple.className = 'interaction-ripple';
        ripple.style.width = `${size}px`;
        ripple.style.height = `${size}px`;
        ripple.style.left = `${event.clientX - rect.left - size / 2}px`;
        ripple.style.top = `${event.clientY - rect.top - size / 2}px`;

        element.append(ripple);
        window.setTimeout(() => ripple.remove(), 620);
    });
});

const hero = document.querySelector('.hero-shop');

if (hero && !prefersReducedMotion) {
    const moveHero = (event) => {
        const rect = hero.getBoundingClientRect();
        const x = ((event.clientX - rect.left) / rect.width - 0.5) * 2;
        const y = ((event.clientY - rect.top) / rect.height - 0.5) * 2;

        hero.style.setProperty('--hero-x', `${(x * 10).toFixed(2)}px`);
        hero.style.setProperty('--hero-y', `${(y * 7).toFixed(2)}px`);
    };

    hero.addEventListener('pointermove', moveHero);
    hero.addEventListener('pointerleave', () => {
        hero.style.setProperty('--hero-x', '0px');
        hero.style.setProperty('--hero-y', '0px');
    });
}

const cartLink = document.querySelector('.cart-link');
const cartCount = cartLink?.querySelector('span');
let cartTotal = Number.parseInt(cartCount?.textContent ?? '0', 10) || 0;

const toast = document.createElement('div');
toast.className = 'site-toast';
toast.setAttribute('role', 'status');
toast.setAttribute('aria-live', 'polite');
document.body.append(toast);

let toastTimer = null;

const showToast = (message) => {
    toast.textContent = message;
    toast.classList.add('is-visible');
    window.clearTimeout(toastTimer);
    toastTimer = window.setTimeout(() => toast.classList.remove('is-visible'), 2400);
};

const animateCart = () => {
    if (!cartLink) {
        return;
    }

    cartLink.classList.remove('cart-pop');
    void cartLink.offsetWidth;
    cartLink.classList.add('cart-pop');
};

cartLink?.addEventListener('click', (event) => {
    event.preventDefault();
    animateCart();
    showToast(cartTotal > 0 ? `${cartTotal} article(s) dans le panier` : 'Le panier est vide');
});

document.querySelectorAll('[data-product-add]').forEach((button) => {
    button.addEventListener('click', () => {
        const card = button.closest('[data-product-card]');
        const productName = card?.dataset.productName || 'Produit';

        cartTotal += 1;

        if (cartCount) {
            cartCount.textContent = String(cartTotal);
        }

        animateCart();
        showToast(`${productName} ajoute au panier`);
    });
});

document.querySelectorAll('[data-copy-contact]').forEach((button) => {
    button.addEventListener('click', async () => {
        const value = button.dataset.copyContact || '';

        if (!value) {
            return;
        }

        try {
            await navigator.clipboard.writeText(value);
            showToast('Contact copie');
        } catch {
            showToast(value);
        }
    });
});

document.querySelectorAll('[data-notify-template]').forEach((button) => {
    button.addEventListener('click', () => {
        const form = button.closest('.admin-notify-form');
        const subject = form?.querySelector('[name="subject"]');
        const message = form?.querySelector('[name="message"]');

        if (!form || !subject || !message) {
            return;
        }

        subject.value = button.dataset.templateSubject || subject.value;
        message.value = button.dataset.templateMessage || message.value;
        subject.dispatchEvent(new Event('input', { bubbles: true }));
        message.dispatchEvent(new Event('input', { bubbles: true }));
        showToast('Modele insere');
    });
});

const searchForm = document.querySelector('.search-form');
const searchInput = document.querySelector('.search-form input');
const productCards = Array.from(document.querySelectorAll('[data-product-card]'));
const firstProductGrid = document.querySelector('.product-grid');

const searchEmpty = document.createElement('div');
searchEmpty.className = 'search-empty-state';
searchEmpty.textContent = 'Aucun produit ne correspond a cette recherche.';
firstProductGrid?.append(searchEmpty);

const filterProducts = () => {
    const query = searchInput?.value.trim().toLowerCase() || '';
    let visibleProducts = 0;

    productCards.forEach((card) => {
        const productName = (card.dataset.productName || '').toLowerCase();
        const isVisible = query.length === 0 || productName.includes(query);

        card.classList.toggle('is-filtered-out', !isVisible);

        if (isVisible) {
            visibleProducts += 1;
        }
    });

    document.body.classList.toggle('is-searching', query.length > 0);
    searchEmpty.classList.toggle('is-visible', query.length > 0 && visibleProducts === 0);
};

searchInput?.addEventListener('input', () => {
    filterProducts();
});

searchForm?.addEventListener('submit', (event) => {
    event.preventDefault();
    filterProducts();

    const firstVisibleCard = productCards.find((card) => !card.classList.contains('is-filtered-out'));
    firstVisibleCard?.scrollIntoView({ behavior: prefersReducedMotion ? 'auto' : 'smooth', block: 'center' });
});

const requestSection = document.querySelector('.request-section');
const requestForm = document.querySelector('.request-form');

if (requestSection && requestForm) {
    const typeSelect = requestForm.querySelector('select[name="type"]');
    const submitButton = requestForm.querySelector('button[type="submit"]');
    const formControls = Array.from(requestForm.querySelectorAll('input, select, textarea'));

    formControls.forEach((control) => {
        const label = control.closest('label');

        if (!label) {
            return;
        }

        label.dataset.field = control.name;

        const syncFilledState = () => {
            label.classList.toggle('is-filled', control.value.trim().length > 0);
        };

        control.addEventListener('focus', () => label.classList.add('is-active'));
        control.addEventListener('blur', () => label.classList.remove('is-active'));
        control.addEventListener('input', syncFilledState);
        control.addEventListener('change', syncFilledState);
        syncFilledState();
    });

    const syncRequestMode = () => {
        const type = typeSelect?.value || 'question';
        const isReservation = type === 'reservation';
        const service = requestForm.querySelector('[name="service"]');
        const preferredDate = requestForm.querySelector('[name="preferred_date"]');
        const message = requestForm.querySelector('[name="message"]');

        requestSection.classList.toggle('is-reservation', isReservation);

        service?.toggleAttribute('required', isReservation);
        preferredDate?.toggleAttribute('required', isReservation);
        message?.toggleAttribute('required', !isReservation);

        service?.setAttribute('aria-required', String(isReservation));
        preferredDate?.setAttribute('aria-required', String(isReservation));
        message?.setAttribute('aria-required', String(!isReservation));

        if (submitButton) {
            submitButton.textContent = isReservation ? 'Reserver un creneau' : type === 'quote' ? 'Demander un devis' : 'Envoyer la demande';
        }
    };

    typeSelect?.addEventListener('change', syncRequestMode);
    syncRequestMode();
}
