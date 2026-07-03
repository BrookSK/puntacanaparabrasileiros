<?php ob_start(); ?>
<section class="py-5"><div class="container"><div class="row justify-content-center"><div class="col-lg-8">
    <h1 class="fw-bold mb-4">Cancelamentos</h1>
    <div class="text-muted">
        <p>Para solicitar o cancelamento de um passeio ou transfer, utilize uma das opções abaixo:</p>
        <ul>
            <li>Email: <a href="mailto:reservas@puntacanaparabrasileiros.com">reservas@puntacanaparabrasileiros.com</a></li>
            <li>WhatsApp: <a href="https://api.whatsapp.com/send?phone=<?= e(site_config('phone_whatsapp', '18294582170')) ?>"><?= e(site_config('phone_primary', '+1 (829) 458-2170')) ?></a></li>
        </ul>
        <p>Consulte as <a href="<?= base_url('politicas-de-cancelamento') ?>">Políticas de Cancelamento</a> para informações sobre prazos e reembolsos.</p>
    </div>
</div></div></div></section>
<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
