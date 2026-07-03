<?php ob_start(); ?>
<section class="py-5"><div class="container"><div class="row justify-content-center"><div class="col-lg-8">
    <h1 class="fw-bold mb-4">Políticas de Privacidade</h1>
    <div class="text-muted">
        <p>A <?= e(site_config('company_name', 'Punta Cana para Brasileiros')) ?> valoriza a privacidade de seus clientes e visitantes. Esta política descreve como coletamos, usamos e protegemos suas informações pessoais.</p>
        <h4>Coleta de Dados</h4>
        <p>Coletamos informações pessoais quando você se registra em nosso site, realiza uma compra, preenche um formulário ou interage com nossos serviços.</p>
        <h4>Uso das Informações</h4>
        <p>Utilizamos suas informações para processar transações, enviar comunicações sobre seus pedidos, melhorar nosso site e personalizar sua experiência.</p>
        <h4>Proteção de Dados</h4>
        <p>Implementamos medidas de segurança para proteger suas informações pessoais contra acesso não autorizado.</p>
        <h4>Cookies</h4>
        <p>Utilizamos cookies para melhorar sua experiência de navegação. Você pode configurar seu navegador para recusar cookies.</p>
        <h4>Contato</h4>
        <p>Para dúvidas sobre privacidade, entre em contato: <?= e(site_config('admin_email', 'contato@puntacanaparabrasileiros.com')) ?></p>
    </div>
</div></div></div></section>
<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
