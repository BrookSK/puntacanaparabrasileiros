<?php ob_start(); ?>
<section class="py-5"><div class="container"><div class="row justify-content-center"><div class="col-lg-8">
    <h1 class="fw-bold mb-4">Termos e Condições do Programa de Afiliados</h1>
    <div class="text-muted">
        <h4>Comissões</h4>
        <p>Afiliados recebem <?= e(site_config('affiliate_commission_percent', '10')) ?>% de comissão sobre vendas geradas através de seu link exclusivo.</p>
        <h4>Pagamento</h4>
        <p>O pagamento é realizado via PayPal quando o saldo atinge o mínimo de <?= format_money(site_config('affiliate_min_payout', '50')) ?>.</p>
        <h4>Cookie de Rastreamento</h4>
        <p>O cookie de afiliado tem validade de <?= e(site_config('affiliate_cookie_days', '30')) ?> dias.</p>
        <h4>Proibições</h4>
        <p>É proibido usar spam, conteúdo enganoso ou qualquer prática antiética para gerar vendas.</p>
    </div>
</div></div></div></section>
<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
