/**
 * Punta Cana para Brasileiros - Site JavaScript
 * Menu mobile, animações, interações básicas
 */

document.addEventListener('DOMContentLoaded', function() {

    // ========================================
    // MENU MOBILE (Hamburger Toggle)
    // ========================================
    const menuToggles = document.querySelectorAll('.elementor-menu-toggle');
    menuToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            const nav = this.closest('.elementor-widget-container').querySelector('.elementor-nav-menu--dropdown');
            const isOpen = this.getAttribute('aria-expanded') === 'true';
            
            this.setAttribute('aria-expanded', !isOpen);
            if (nav) {
                nav.setAttribute('aria-hidden', isOpen);
                nav.style.display = isOpen ? 'none' : 'block';
            }
            
            // Toggle body class
            document.body.classList.toggle('elementor-menu--open', !isOpen);
        });
    });

    // ========================================
    // SMARTMENUS - Dropdown on hover (desktop)
    // ========================================
    const menuItems = document.querySelectorAll('.elementor-nav-menu > li.menu-item-has-children');
    menuItems.forEach(function(item) {
        item.addEventListener('mouseenter', function() {
            const submenu = this.querySelector('.sub-menu');
            if (submenu) submenu.style.display = 'block';
        });
        item.addEventListener('mouseleave', function() {
            const submenu = this.querySelector('.sub-menu');
            if (submenu) submenu.style.display = '';
        });
    });

    // ========================================
    // SCROLL ANIMATIONS (Fade In on Scroll)
    // ========================================
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('e-lazyloaded');
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe elements that need animation
    document.querySelectorAll('.e-con.e-parent:not(.e-lazyloaded)').forEach(function(el) {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });

    // ========================================
    // LAZY LOAD IMAGES (data-src -> src)
    // ========================================
    const lazyImages = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                }
                if (img.dataset.srcset) {
                    img.srcset = img.dataset.srcset;
                    img.removeAttribute('data-srcset');
                }
                img.classList.remove('lazyload', 'lazyloading');
                img.classList.add('lazyloaded');
                imageObserver.unobserve(img);
            }
        });
    }, { rootMargin: '200px' });

    lazyImages.forEach(function(img) {
        imageObserver.observe(img);
    });

    // ========================================
    // COOKIE CONSENT - Accept button
    // ========================================
    const cookieAcceptBtns = document.querySelectorAll('.cky-btn-accept');
    cookieAcceptBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const container = document.querySelector('.cky-consent-container');
            const overlay = document.querySelector('.cky-overlay');
            if (container) container.classList.add('cky-hide');
            if (overlay) overlay.classList.add('cky-hide');
            localStorage.setItem('cky-consent', 'accepted');
        });
    });

    // Hide cookie bar if already accepted
    if (localStorage.getItem('cky-consent') === 'accepted') {
        const container = document.querySelector('.cky-consent-container');
        const overlay = document.querySelector('.cky-overlay');
        if (container) container.classList.add('cky-hide');
        if (overlay) overlay.classList.add('cky-hide');
    } else {
        // Show cookie bar
        const container = document.querySelector('.cky-consent-container');
        if (container) container.classList.remove('cky-hide');
    }

    // ========================================
    // JOINCHAT - WhatsApp button toggle
    // ========================================
    const joinchatBtn = document.querySelector('.joinchat__button');
    const joinchatBox = document.querySelector('.joinchat__chatbox');
    if (joinchatBtn && joinchatBox) {
        joinchatBtn.addEventListener('click', function() {
            const joinchat = document.querySelector('.joinchat');
            joinchat.classList.toggle('joinchat--chatbox');
        });
        
        const closeBtn = document.querySelector('.joinchat__close');
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                document.querySelector('.joinchat').classList.remove('joinchat--chatbox');
            });
        }
    }

    // ========================================
    // SCROLL TO TOP
    // ========================================
    const scrollTopBtn = document.querySelector('.to_top');
    if (scrollTopBtn) {
        window.addEventListener('scroll', function() {
            scrollTopBtn.style.display = window.scrollY > 300 ? 'block' : 'none';
        });
        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // ========================================
    // SMOOTH SCROLL for anchor links
    // ========================================
    document.querySelectorAll('a[href^="#"]').forEach(function(link) {
        link.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // ========================================
    // SELECT2 basic replacement for transfer form
    // ========================================
    const transferSelects = document.querySelectorAll('.transfer-location-select');
    transferSelects.forEach(function(select) {
        select.style.appearance = 'none';
        select.style.padding = '12px 15px';
        select.style.borderRadius = '10px';
    });

    // ========================================
    // TRANSFER FORM - Type tabs toggle
    // ========================================
    const typeBtns = document.querySelectorAll('.wte-transfer-type-btn');
    typeBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            typeBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // ========================================
    // ACCORDION (Elementor nested accordion)
    // ========================================
    document.querySelectorAll('.e-n-accordion-item-title').forEach(function(title) {
        title.addEventListener('click', function() {
            const item = this.closest('.e-n-accordion-item');
            if (item) {
                const isOpen = item.hasAttribute('open');
                // Close others if max_items_expended is "one"
                const accordion = item.closest('.e-n-accordion');
                if (accordion) {
                    accordion.querySelectorAll('.e-n-accordion-item[open]').forEach(function(openItem) {
                        if (openItem !== item) openItem.removeAttribute('open');
                    });
                }
            }
        });
    });

    // ========================================
    // PASSENGERS DROPDOWN (Transfer form)
    // ========================================
    const passToggle = document.querySelector('.passengers-toggle');
    const passDropdown = document.querySelector('.passengers-dropdown');
    if (passToggle && passDropdown) {
        passToggle.addEventListener('click', function() {
            const isVisible = passDropdown.style.display !== 'none';
            passDropdown.style.display = isVisible ? 'none' : 'block';
        });
        
        // Close on outside click
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.passengers-field')) {
                if (passDropdown) passDropdown.style.display = 'none';
            }
        });
    }

});
