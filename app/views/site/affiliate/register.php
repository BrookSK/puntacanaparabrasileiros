<?php ob_start(); ?>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h2 class="fw-bold">Tornar-se Afiliado</h2>
                <p class="text-muted">Você ainda não é um afiliado. Solicite sua participação no programa!</p>
                <a href="<?= base_url('programa-de-afiliados') ?>" class="btn btn-primary btn-lg">Conhecer o Programa</a>
            </div>
        </div>
    </div>
</section>
<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
