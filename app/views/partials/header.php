<header class="site-header">
    <!-- Top bar -->
    <div class="top-bar d-none d-lg-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex gap-3 align-items-center">
                <span class="small"><i class="bi bi-telephone"></i> <?= e(site_config('phone_primary', '+1 (829) 458-2170')) ?></span>
                <span class="small"><i class="bi bi-envelope"></i> <?= e(site_config('admin_email', 'contato@puntacanaparabrasileiros.com')) ?></span>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <!-- Idiomas -->
                <div class="dropdown">
                    <button class="btn btn-sm btn-link text-white dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bi bi-globe"></i> PT
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Português</a></li>
                        <li><a class="dropdown-item" href="#">English</a></li>
                        <li><a class="dropdown-item" href="#">Español</a></li>
                    </ul>
                </div>
                <!-- Social -->
                <?php if (site_config('instagram_url')): ?>
                <a href="<?= e(site_config('instagram_url')) ?>" target="_blank" class="text-white"><i class="bi bi-instagram"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Navbar Principal -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <?php if (site_config('logo_url')): ?>
                    <img src="<?= e(site_config('logo_url')) ?>" alt="<?= e(site_config('site_name')) ?>" height="40">
                <?php else: ?>
                    <span class="fw-bold"><?= e(site_config('site_name', 'Punta Cana para Brasileiros')) ?></span>
                <?php endif; ?>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= is_current_page('') ? 'active' : '' ?>" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= is_current_page('experiencias') || is_current_page('passeios') ? 'active' : '' ?>" href="<?= base_url('experiencias') ?>">Passeios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= is_current_page('transfer') ? 'active' : '' ?>" href="<?= base_url('transfer') ?>">Transfer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= is_current_page('blog') ? 'active' : '' ?>" href="<?= base_url('blog') ?>">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= is_current_page('sobre-nos') ? 'active' : '' ?>" href="<?= base_url('sobre-nos') ?>">Sobre Nós</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= is_current_page('contato') ? 'active' : '' ?>" href="<?= base_url('contato') ?>">Contato</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2">
                    <a href="<?= base_url('busca') ?>" class="btn btn-link text-white" title="Buscar">
                        <i class="bi bi-search"></i>
                    </a>
                    <a href="<?= base_url('carrinho') ?>" class="btn btn-link text-white position-relative" title="Carrinho">
                        <i class="bi bi-cart3"></i>
                        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?= count($_SESSION['cart']) ?>
                        </span>
                        <?php endif; ?>
                    </a>
                    <a href="<?= base_url('lista-de-desejos') ?>" class="btn btn-link text-white" title="Lista de Desejos">
                        <i class="bi bi-heart"></i>
                    </a>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="<?= base_url('minha-conta') ?>" class="btn btn-link text-white" title="Minha Conta">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <?php else: ?>
                    <a href="<?= base_url('login') ?>" class="btn btn-link text-white" title="Login">
                        <i class="bi bi-person"></i>
                    </a>
                    <?php endif; ?>
                    <a href="<?= base_url('experiencias') ?>" class="btn btn-primary btn-sm d-none d-xl-inline-block">
                        Agendar Agora
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
