<?php require_once VIEWS_PATH . '/partials/wp-header.php'; ?>

<div class="main-content-wrapper container" style="max-width: 1290px; margin: 0 auto; padding: 40px 20px; min-height: 50vh;">
    <?php if (isset($pageTitle)): ?>
    <h1 style="font-family: 'Poppins', sans-serif; font-size: 40px; font-weight: 600; color: #1C2011; margin-bottom: 30px;"><?= htmlspecialchars($pageTitle) ?></h1>
    <?php endif; ?>
    
    <?php echo $content ?? ''; ?>
</div>

<?php require_once VIEWS_PATH . '/partials/wp-footer.php'; ?>
