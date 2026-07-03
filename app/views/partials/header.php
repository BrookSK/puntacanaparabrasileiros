<header class="site-navbar" id="siteNavbar">
    <div class="container">
        <!-- Logo -->
        <a href="<?= base_url() ?>" class="navbar-logo">
            <?php if (site_config('logo_url')): ?>
                <img src="<?= e(site_config('logo_url')) ?>" alt="<?= e(site_config('site_name')) ?>">
            <?php else: ?>
                <img src="https://puntacanaparabrasileiros.com/wp-content/uploads/2025/04/PUNTA-CANA-1.png" alt="Punta Cana para Brasileiros">
            <?php endif; ?>
        </a>

        <!-- Menu Principal -->
        <ul class="navbar-menu" id="navMenu">
            <li><a href="<?= base_url() ?>" class="<?= is_current_page('') ? 'active' : '' ?>">Home</a></li>
            <li><a href="<?= base_url('experiencias') ?>" class="<?= is_current_page('experiencias') || is_current_page('passeios') ? 'active' : '' ?>">Passeios</a></li>
            <li><a href="<?= base_url('transfer') ?>" class="<?= is_current_page('transfer') ? 'active' : '' ?>">Transfer</a></li>
            <li><a href="<?= base_url('blog') ?>" class="<?= is_current_page('blog') ? 'active' : '' ?>">Blog</a></li>
            <li><a href="<?= base_url('sobre-nos') ?>" class="<?= is_current_page('sobre-nos') ? 'active' : '' ?>">Sobre Nós</a></li>
            <li><a href="<?= base_url('contato') ?>" class="<?= is_current_page('contato') ? 'active' : '' ?>">Contato</a></li>
        </ul>

        <!-- Ações -->
        <div class="navbar-actions">
            <!-- Bandeiras de idioma -->
            <div class="navbar-flags">
                <img src="https://flagcdn.com/w20/us.png" alt="EN" title="English">
                <img src="https://flagcdn.com/w20/br.png" alt="PT" class="active" title="Português">
                <img src="https://flagcdn.com/w20/es.png" alt="ES" title="Español">
            </div>

            <a href="<?= base_url('busca') ?>" class="nav-icon" title="Buscar"><i class="bi bi-search"></i></a>
            <a href="https://www.instagram.com/puntacanaparabrasileiros" target="_blank" class="nav-icon" title="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="<?= base_url('carrinho') ?>" class="nav-icon" title="Carrinho">
                <i class="bi bi-cart3"></i>
                <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                <span class="cart-count"><?= count($_SESSION['cart']) ?></span>
                <?php endif; ?>
            </a>
            <a href="https://api.whatsapp.com/send?phone=<?= e(site_config('phone_whatsapp', '18294582170')) ?>" target="_blank" class="nav-icon" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
            <?php if (isset($_SESSION['user_id'])): ?>
            <a href="<?= base_url('minha-conta') ?>" class="nav-icon" title="Minha Conta"><i class="bi bi-person-circle"></i></a>
            <?php else: ?>
            <a href="<?= base_url('login') ?>" class="nav-icon" title="Login"><i class="bi bi-person"></i></a>
            <?php endif; ?>
            <a href="<?= base_url('lista-de-desejos') ?>" class="nav-icon" title="Lista de Desejos"><i class="bi bi-heart"></i></a>

            <a href="<?= base_url('experiencias') ?>" class="btn-agendar">Agendar Agora</a>
        </div>

        <!-- Mobile Toggle -->
        <button class="navbar-toggle" id="navToggle" aria-label="Menu">
            <i class="bi bi-list"></i>
        </button>
    </div>
</header>
