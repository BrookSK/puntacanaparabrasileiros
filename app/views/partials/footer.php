<footer class="site-footer bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row g-4">
            <!-- Sobre -->
            <div class="col-lg-4 col-md-6">
                <?php if (site_config('logo_url')): ?>
                    <img src="<?= e(site_config('logo_url')) ?>" alt="<?= e(site_config('site_name')) ?>" class="mb-3" height="50">
                <?php else: ?>
                    <h5 class="fw-bold mb-3"><?= e(site_config('site_name', 'Punta Cana para Brasileiros')) ?></h5>
                <?php endif; ?>
                <p class="text-muted small"><?= e(site_config('site_description', 'A melhor agência especializada em viagens para Punta Cana com atendimento personalizado para brasileiros.')) ?></p>
                <div class="d-flex gap-3 mt-3">
                    <?php if (site_config('instagram_url')): ?>
                    <a href="<?= e(site_config('instagram_url')) ?>" target="_blank" class="text-white fs-5"><i class="bi bi-instagram"></i></a>
                    <?php endif; ?>
                    <?php if (site_config('threads_url')): ?>
                    <a href="<?= e(site_config('threads_url')) ?>" target="_blank" class="text-white fs-5"><i class="bi bi-threads"></i></a>
                    <?php endif; ?>
                    <a href="https://api.whatsapp.com/send?phone=<?= e(site_config('phone_whatsapp', '18294582170')) ?>" target="_blank" class="text-white fs-5"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>

            <!-- Mapa do Site -->
            <div class="col-lg-2 col-md-6">
                <h6 class="fw-bold mb-3">Mapa do Site</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="<?= base_url() ?>" class="text-muted text-decoration-none">Home</a></li>
                    <li class="mb-2"><a href="<?= base_url('experiencias') ?>" class="text-muted text-decoration-none">Experiências</a></li>
                    <li class="mb-2"><a href="<?= base_url('programa-de-afiliados') ?>" class="text-muted text-decoration-none">Afiliados</a></li>
                    <li class="mb-2"><a href="<?= base_url('blog') ?>" class="text-muted text-decoration-none">Blog</a></li>
                    <li class="mb-2"><a href="<?= base_url('sobre-nos') ?>" class="text-muted text-decoration-none">Sobre Nós</a></li>
                    <li class="mb-2"><a href="<?= base_url('contato') ?>" class="text-muted text-decoration-none">Contato</a></li>
                </ul>
            </div>

            <!-- Sobre Punta Cana -->
            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold mb-3">Sobre Punta Cana</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="<?= base_url('passeios') ?>" class="text-muted text-decoration-none">Passeios</a></li>
                    <li class="mb-2"><a href="<?= base_url('busca') ?>" class="text-muted text-decoration-none">Busca</a></li>
                    <li class="mb-2"><a href="<?= base_url('minha-conta') ?>" class="text-muted text-decoration-none">Minha Conta</a></li>
                    <li class="mb-2"><a href="<?= base_url('conta-de-afiliado') ?>" class="text-muted text-decoration-none">Conta de Afiliado</a></li>
                    <li class="mb-2"><a href="<?= base_url('lista-de-desejos') ?>" class="text-muted text-decoration-none">Lista de Desejos</a></li>
                </ul>
            </div>

            <!-- Termos & Políticas -->
            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold mb-3">Termos & Políticas</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="<?= base_url('politicas-de-privacidade') ?>" class="text-muted text-decoration-none">Políticas de Privacidade</a></li>
                    <li class="mb-2"><a href="<?= base_url('politicas-de-cancelamento') ?>" class="text-muted text-decoration-none">Políticas de Cancelamento</a></li>
                    <li class="mb-2"><a href="<?= base_url('termos-e-condicoes-do-programa-de-afiliados') ?>" class="text-muted text-decoration-none">Políticas de Afiliados</a></li>
                    <li class="mb-2"><a href="<?= base_url('termos-e-condicoes') ?>" class="text-muted text-decoration-none">Termos e Condições</a></li>
                    <li class="mb-2"><a href="<?= base_url('cancelamentos') ?>" class="text-muted text-decoration-none">Cancelamentos</a></li>
                </ul>
            </div>
        </div>

        <hr class="border-secondary my-4">

        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="small text-muted mb-0">
                    <?= e(site_config('footer_text', '© Copyright 2025 | Desenvolvido por LRV Web')) ?><br>
                    <?= e(site_config('company_name', 'Punta Cana para Brasileiros Oliveira & Ramos SRL')) ?> 
                    RNC: <?= e(site_config('company_rnc', '133287765')) ?>
                </p>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <p class="small text-muted mb-0">Pagamento seguro</p>
                <div class="d-flex gap-2 justify-content-md-end mt-1">
                    <i class="bi bi-paypal fs-4 text-muted"></i>
                    <i class="bi bi-credit-card fs-4 text-muted"></i>
                </div>
            </div>
        </div>
    </div>
</footer>
