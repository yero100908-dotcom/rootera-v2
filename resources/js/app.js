// Navbar scroll effect
const navbar = document.getElementById('navbar');
if (navbar) {
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 20);
    });
}

// Mobile hamburger
const hamburgerBtn = document.getElementById('hamburger-btn');
const mobileMenu   = document.getElementById('mobile-menu');
if (hamburgerBtn && mobileMenu) {
    hamburgerBtn.addEventListener('click', () => {
        const isOpen = mobileMenu.classList.toggle('open');
        hamburgerBtn.classList.toggle('open', isOpen);
        hamburgerBtn.setAttribute('aria-expanded', isOpen);
    });
    // Close on outside click
    document.addEventListener('click', (e) => {
        if (!hamburgerBtn.contains(e.target) && !mobileMenu.contains(e.target)) {
            mobileMenu.classList.remove('open');
            hamburgerBtn.classList.remove('open');
            hamburgerBtn.setAttribute('aria-expanded', 'false');
        }
    });
}

// Intersection Observer - fade in on scroll
const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

// Counter animation
function animateCounter(el) {
    const target  = parseInt(el.getAttribute('data-target') || el.textContent, 10);
    const suffix  = el.getAttribute('data-suffix') || '';
    const duration = 1800;
    const start   = performance.now();
    const update  = (time) => {
        const elapsed  = time - start;
        const progress = Math.min(elapsed / duration, 1);
        const eased    = 1 - Math.pow(1 - progress, 3);
        el.textContent = Math.floor(eased * target) + suffix;
        if (progress < 1) requestAnimationFrame(update);
    };
    requestAnimationFrame(update);
}

const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateCounter(entry.target);
            counterObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.5 });

document.querySelectorAll('[data-counter]').forEach(el => counterObserver.observe(el));

// Flash message auto-dismiss
const alerts = document.querySelectorAll('.alert-auto-dismiss');
alerts.forEach(alert => {
    setTimeout(() => {
        alert.style.opacity = '0';
        alert.style.transition = 'opacity .4s ease';
        setTimeout(() => alert.remove(), 400);
    }, 5000);
});

// FAQ Accordion
document.querySelectorAll('.faq-question').forEach(button => {
    button.addEventListener('click', () => {
        const expanded = button.getAttribute('aria-expanded') === 'true';
        // Optional: close others
        document.querySelectorAll('.faq-question').forEach(btn => btn.setAttribute('aria-expanded', 'false'));
        // Toggle current
        button.setAttribute('aria-expanded', !expanded);
    });
});
