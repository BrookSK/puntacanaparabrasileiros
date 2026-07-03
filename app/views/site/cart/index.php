<?php ob_start(); ?>

<section class="py-5">
    <div class="container">
        <h1 class="fw-bold mb-4"><i class="bi bi-cart3"></i> Carrinho</h1>

        <?php if (empty($cart)): ?>
        <div class="text-center py-5">
            <i class="bi bi-cart-x fs-1 text-muted"></i>
            <h4 class="mt-3">Seu carrinho está vazio</h4>
            <p class="text-muted">Explore nossos passeios e transfers para começar.</p>
            <a href="<?= base_url('experiencias') ?>" class="btn btn-primary">Ver Passeios</a>
        </div>
        <?php else: ?>
        <div class="row g-4">
            <div class="col-lg-8">
                <?php foreach ($cart as $item): ?>
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="fw-bold"><?= e($item['name']) ?></h5>
                                <?php if ($item['package_name']): ?>
                                <span class="badge bg-primary-subtle text-primary"><?= e($item['package_name']) ?></span>
                                <?php endif; ?>
                                <p class="text-muted small mt-2 mb-0">
                                    <?php if ($item['date']): ?><i class="bi bi-calendar"></i> <?= format_date($item['date']) ?><?php endif; ?>
                                    <?php if ($item['adults']): ?> | <i class="bi bi-people"></i> <?= $item['adults'] ?> adulto(s)<?php endif; ?>
                                    <?php if ($item['children']): ?>, <?= $item['children'] ?> criança(s)<?php endif; ?>
                                </p>
                            </div>
                            <div class="text-end">
                                <h5 class="fw-bold text-primary"><?= format_money($item['total_price']) ?></h5>
                                <a href="<?= base_url('carrinho/remover?cart_id=' . $item['id']) ?>" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i> Remover
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Resumo</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span class="fw-bold"><?= format_money(array_sum(array_column($cart, 'total_price'))) ?></span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold">Total</span>
                            <span class="fw-bold text-primary fs-5"><?= format_money(array_sum(array_column($cart, 'total_price'))) ?></span>
                        </div>
                        <a href="<?= base_url('checkout') ?>" class="btn btn-primary w-100 btn-lg">
                            <i class="bi bi-credit-card"></i> Ir para Checkout
                        </a>
                        <a href="<?= base_url('experiencias') ?>" class="btn btn-outline-secondary w-100 mt-2">
                            Continuar Comprando
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
