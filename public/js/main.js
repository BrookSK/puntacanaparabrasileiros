/**
 * Punta Cana para Brasileiros - JavaScript Principal
 */

// Inicializar AOS
document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 800,
        once: true,
        offset: 50,
    });

    // Inicializar Swiper (Depoimentos)
    if (document.querySelector('.testimonials-swiper')) {
        new Swiper('.testimonials-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: { el: '.swiper-pagination', clickable: true },
            autoplay: { delay: 5000 },
            breakpoints: {
                768: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
            },
        });
    }

    // Cookie Banner
    initCookieBanner();

    // Counter Animation
    initCounters();
});

// Cookie Banner
function initCookieBanner() {
    const banner = document.getElementById('cookieBanner');
    if (!banner) return;
    
    if (!localStorage.getItem('cookies_accepted')) {
        banner.style.display = 'block';
    }
}

function acceptCookies() {
    localStorage.setItem('cookies_accepted', '1');
    const banner = document.getElementById('cookieBanner');
    if (banner) banner.style.display = 'none';
}

// Counter Animation
function initCounters() {
    const counters = document.querySelectorAll('.counter');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.dataset.target);
                animateCounter(entry.target, target);
                observer.unobserve(entry.target);
            }
        });
    });

    counters.forEach(counter => observer.observe(counter));
}

function animateCounter(element, target) {
    let current = 0;
    const increment = target / 60;
    const duration = 2000;
    const stepTime = duration / 60;

    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current);
        }
    }, stepTime);
}

// Adicionar ao Carrinho (AJAX)
function addToCart(itemType, itemId, data) {
    fetch(window.location.origin + '/carrinho/adicionar', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ item_type: itemType, item_id: itemId, ...data })
    })
    .then(res => res.json())
    .then(result => {
        if (result.success) {
            // Atualizar badge do carrinho
            const badge = document.querySelector('.cart-badge');
            if (badge) badge.textContent = result.cart_count;
            
            // Toast de sucesso
            showToast('Item adicionado ao carrinho!', 'success');
        } else {
            showToast(result.message || 'Erro ao adicionar ao carrinho', 'error');
        }
    })
    .catch(() => showToast('Erro de conexão', 'error'));
}

// Toast notifications
function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `alert alert-${type === 'success' ? 'success' : 'danger'} position-fixed`;
    toast.style.cssText = 'top: 80px; right: 20px; z-index: 9999; min-width: 250px;';
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => toast.remove(), 3000);
}
