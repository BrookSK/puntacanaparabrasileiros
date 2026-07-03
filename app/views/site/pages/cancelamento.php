<?php ob_start(); ?>
<section class="py-5"><div class="container"><div class="row justify-content-center"><div class="col-lg-8">
    <h1 class="fw-bold mb-4">Políticas de Cancelamento</h1>
    <div class="text-muted">
        <p>Entendemos que imprevistos acontecem. Confira abaixo nossa política de cancelamento para passeios e transfers.</p>
        <h4>Passeios</h4>
        <ul>
            <li>Cancelamento com mais de 48h de antecedência: reembolso total</li>
            <li>Cancelamento entre 24h e 48h: reembolso de 50%</li>
            <li>Cancelamento com menos de 24h: sem reembolso</li>
        </ul>
        <h4>Transfers</h4>
        <ul>
            <li>Cancelamento com mais de 24h de antecedência: reembolso total</li>
            <li>Cancelamento com menos de 24h: sem reembolso</li>
        </ul>
        <h4>Como solicitar cancelamento</h4>
        <p>Envie um email para reservas@puntacanaparabrasileiros.com ou entre em contato pelo WhatsApp.</p>
    </div>
</div></div></div></section>
<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
