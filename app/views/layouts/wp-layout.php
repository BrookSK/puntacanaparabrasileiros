<?php require_once VIEWS_PATH . '/partials/wp-header.php'; ?>

<div class="main-content-wrapper container" style="max-width: 1290px; margin: 0 auto; padding: 40px 20px; min-height: 50vh;">
    <?php echo $content ?? ''; ?>
</div>

<?php require_once VIEWS_PATH . '/partials/wp-footer.php'; ?>
