<?php ob_start(); ?>
<section class="py-5"><div class="container"><div class="row justify-content-center"><div class="col-lg-8">
    <h1 class="fw-bold mb-4">Termos e Condições</h1>
    <div class="text-muted">
        <p>Ao utilizar os serviços da <?= e(site_config('company_name', 'Punta Cana para Brasileiros')) ?>, você concorda com os seguintes termos e condições.</p>
        <h4>Serviços</h4>
        <p>Oferecemos serviços de agendamento de passeios e transfers em Punta Cana, República Dominicana.</p>
        <h4>Pagamento</h4>
        <p>Todos os preços são em dólares americanos (USD). O pagamento é processado via PayPal.</p>
        <h4>Responsabilidades</h4>
        <p>A empresa atua como intermediária entre o cliente e os prestadores de serviço locais.</p>
        <h4>Alterações</h4>
        <p>Reservamo-nos o direito de alterar estes termos a qualquer momento. As alterações entram em vigor imediatamente após publicação.</p>
    </div>
</div></div></div></section>
<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
