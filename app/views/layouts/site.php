<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title><?= e($pageTitle ?? 'Punta Cana para Brasileiros') ?></title>
    <meta name="description" content="<?= e(site_config('site_description', 'Descubra o paraíso caribenho com os melhores pacotes exclusivos para brasileiros.')) ?>">
    <meta name="keywords" content="<?= e(site_config('site_keywords')) ?>">
    
    <!-- Favicon -->
    <link rel="icon" href="https://puntacanaparabrasileiros.com/wp-content/uploads/2025/04/cropped-zipwp-image-5876-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="https://puntacanaparabrasileiros.com/wp-content/uploads/2025/04/cropped-zipwp-image-5876-180x180.png">

    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Swiper CSS -->
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">
    <!-- AOS Animations -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= asset('css/style.css') ?>" rel="stylesheet">

    <?php if (site_config('google_analytics_id')): ?>
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
        <div class="container">
            <p>Utilizamos ferramentas e serviços de terceiros que utilizam cookies. Essas ferramentas nos ajudam a oferecer uma melhor experiência de navegação no site. 
            <a href="<?= base_url('politicas-de-privacidade') ?>">Políticas de Privacidade</a></p>
            <button class="btn-cookie" onclick="acceptCookies()">Concordo</button>
        </div>
    </div>

    <!-- Header/Navbar -->
    <?php include VIEWS_PATH . '/partials/header.php'; ?>

    <!-- Flash Messages -->
    <?php if (has_flash('success')): ?>
    <div class="flash-message flash-success" style="position:fixed;top:80px;right:20px;z-index:9999;background:#2ecc71;color:#fff;padding:15px 25px;border-radius:10px;font-size:0.9rem;box-shadow:0 5px 20px rgba(0,0,0,0.3);">
        <?= flash('success') ?>
    </div>
    <?php endif; ?>
    <?php if (has_flash('error')): ?>
    <div class="flash-message flash-error" style="position:fixed;top:80px;right:20px;z-index:9999;background:#e74c3c;color:#fff;padding:15px 25px;border-radius:10px;font-size:0.9rem;box-shadow:0 5px 20px rgba(0,0,0,0.3);">
        <?= flash('error') ?>
    </div>
    <?php endif; ?>

    <!-- Main Content -->
    <main>
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="<?= asset('js/main.js') ?>"></script>

    <?php if (site_config('custom_js')): ?>
    <script><?= site_config('custom_js') ?></script>
    <?php endif; ?>
</body>
</html>
