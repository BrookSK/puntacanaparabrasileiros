<?php ob_start(); ?>
<section class="py-5 bg-primary text-white text-center">
    <div class="container">
        <h1 class="display-5 fw-bold">Programa de Afiliados</h1>
        <p class="lead text-white-50">Ganhe comissões divulgando os melhores passeios de Punta Cana!</p>
    </div>
</section>
<section class="py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h2 class="fw-bold">Como Funciona?</h2>
                <div class="d-flex gap-3 mb-3"><div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;">1</div><div><h5>Cadastre-se</h5><p class="text-muted">Crie sua conta e solicite participação no programa.</p></div></div>
                <div class="d-flex gap-3 mb-3"><div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;">2</div><div><h5>Divulgue</h5><p class="text-muted">Compartilhe seu link exclusivo nas redes sociais, blog ou site.</p></div></div>
                <div class="d-flex gap-3 mb-3"><div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;">3</div><div><h5>Ganhe Comissões</h5><p class="text-muted">Receba <?= e(site_config('affiliate_commission_percent', '10')) ?>% de comissão em cada venda via PayPal.</p></div></div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm p-4 text-center">
                    <h3 class="fw-bold text-primary"><?= e(site_config('affiliate_commission_percent', '10')) ?>%</h3>
                    <p class="text-muted">de comissão por venda</p>
                    <h5>Valor mínimo para saque: <?= format_money(site_config('affiliate_min_payout', '50')) ?></h5>
                    <p class="small text-muted">Cookie de <?= e(site_config('affiliate_cookie_days', '30')) ?> dias</p>
                    <a href="<?= base_url('registro') ?>" class="btn btn-primary btn-lg mt-3">Quero ser Afiliado</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
