<?php ob_start(); ?>

<section class="py-5">
    <div class="container">
        <h1 class="fw-bold mb-4">Minha Conta</h1>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="nav-link active" href="<?= base_url('minha-conta') ?>"><i class="bi bi-person"></i> Meu Perfil</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('minha-conta/pedidos') ?>"><i class="bi bi-receipt"></i> Meus Pedidos</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('lista-de-desejos') ?>"><i class="bi bi-heart"></i> Lista de Desejos</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('conta-de-afiliado') ?>"><i class="bi bi-share"></i> Afiliado</a></li>
                            <li class="nav-item"><a class="nav-link text-danger" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right"></i> Sair</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3">Meu Perfil</h4>
                        <div class="row g-3">
                            <div class="col-md-6"><strong>Nome:</strong><br><?= e($user['name'] ?? '') ?></div>
                            <div class="col-md-6"><strong>Email:</strong><br><?= e($user['email'] ?? '') ?></div>
                            <div class="col-md-6"><strong>Telefone:</strong><br><?= e($user['phone'] ?? 'Não informado') ?></div>
                            <div class="col-md-6"><strong>Membro desde:</strong><br><?= format_date($user['created_at'] ?? '') ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
