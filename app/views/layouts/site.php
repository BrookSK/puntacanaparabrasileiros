<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Punta Cana para Brasileiros') ?></title>
    <meta name="description" content="<?= e(site_config('site_description')) ?>">
    <meta name="keywords" content="<?= e(site_config('site_keywords')) ?>">
    
    <!-- Favicon -->
    <?php if (site_config('favicon_url')): ?>
    <link rel="icon" href="<?= e(site_config('favicon_url')) ?>">
    <?php endif; ?>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- AOS Animations -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- Swiper CSS -->
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= asset('css/style.css') ?>" rel="stylesheet">

    <?php if (site_config('google_analytics_id')): ?>
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= e(site_config('google_analytics_id')) ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?= e(site_config('google_analytics_id')) ?>');
    </script>
    <?php endif; ?>

    <?php if (site_config('custom_css')): ?>
    <style><?= site_config('custom_css') ?></style>
    <?php endif; ?>
</head>
<body>
    <!-- Cookie Banner -->
    <div id="cookieBanner" class="cookie-banner" style="display:none;">
        <div class="container d-flex align-items-center justify-content-between flex-wrap gap-2">
            <p class="mb-0 small">Utilizamos ferramentas e serviços de terceiros que utilizam cookies. 
            <a href="<?= base_url('politicas-de-privacidade') ?>">Políticas de Privacidade</a></p>
            <button class="btn btn-primary btn-sm" onclick="acceptCookies()">Concordo</button>
        </div>
    </div>

    <!-- Header/Navbar -->
    <?php include VIEWS_PATH . '/partials/header.php'; ?>

    <!-- Main Content -->
    <main>
        <?php if (has_flash('success')): ?>
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show">
                <?= flash('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        <?php endif; ?>

        <?php if (has_flash('error')): ?>
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show">
                <?= flash('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        <?php endif; ?>

        <?= $content ?? '' ?>
    </main>

    <!-- Footer -->
    <?php include VIEWS_PATH . '/partials/footer.php'; ?>

    <!-- WhatsApp Float Button -->
    <a href="https://api.whatsapp.com/send?phone=<?= e(site_config('phone_whatsapp', '18294582170')) ?>&text=Oi%2C%20tudo%20bem%3F" 
       class="whatsapp-float" target="_blank" title="Fale conosco no WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="<?= asset('js/main.js') ?>"></script>

    <?php if (site_config('custom_js')): ?>
    <script><?= site_config('custom_js') ?></script>
    <?php endif; ?>
</body>
</html>
