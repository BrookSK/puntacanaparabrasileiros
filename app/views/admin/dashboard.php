<?php ob_start(); ?>

<div class="container-fluid py-4">
    <h1 class="h3 fw-bold mb-4"><i class="bi bi-speedometer2"></i> Dashboard</h1>

    <!-- Cards de Estatísticas -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Clientes</p>
                            <h3 class="fw-bold"><?= $totalClients ?? 0 ?></h3>
                        </div>
                        <div class="bg-primary-subtle rounded-circle p-3">
                            <i class="bi bi-people text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Pedidos Pendentes</p>
                            <h3 class="fw-bold"><?= $pendingOrders ?? 0 ?></h3>
                        </div>
                        <div class="bg-warning-subtle rounded-circle p-3">
                            <i class="bi bi-clock text-warning fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Receita do Mês</p>
                            <h3 class="fw-bold"><?= format_money($monthlyRevenue ?? 0) ?></h3>
                        </div>
                        <div class="bg-success-subtle rounded-circle p-3">
                            <i class="bi bi-currency-dollar text-success fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Afiliados</p>
                            <h3 class="fw-bold"><?= $totalAffiliates ?? 0 ?></h3>
                        </div>
                        <div class="bg-info-subtle rounded-circle p-3">
                            <i class="bi bi-share text-info fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Ações Rápidas</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="<?= base_url('admin/passeios/criar') ?>" class="btn btn-outline-primary w-100 py-3">
                                <i class="bi bi-plus-circle d-block fs-3"></i>
                                Novo Passeio
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="<?= base_url('admin/blog/criar') ?>" class="btn btn-outline-success w-100 py-3">
                                <i class="bi bi-pencil-square d-block fs-3"></i>
                                Novo Post
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="<?= base_url('admin/pedidos') ?>" class="btn btn-outline-warning w-100 py-3">
                                <i class="bi bi-receipt d-block fs-3"></i>
                                Ver Pedidos
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Info do Sistema</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">PHP</span>
                            <span><?= phpversion() ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Moeda</span>
                            <span><?= e(site_config('currency', 'USD')) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">PayPal</span>
                            <span class="badge bg-<?= site_config('paypal_mode') === 'live' ? 'success' : 'warning' ?>">
                                <?= e(site_config('paypal_mode', 'sandbox')) ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/admin.php'; ?>
