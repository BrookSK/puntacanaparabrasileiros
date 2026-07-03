<?php ob_start(); ?>

<section class="py-5">
    <div class="container">
        <h1 class="fw-bold mb-4">Meus Pedidos</h1>

        <?php if (empty($orders)): ?>
        <div class="text-center py-5">
            <i class="bi bi-receipt fs-1 text-muted"></i>
            <h4 class="mt-3">Nenhum pedido encontrado</h4>
            <a href="<?= base_url('experiencias') ?>" class="btn btn-primary mt-2">Ver Passeios</a>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Pedido</th>
                        <th>Data</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><strong><?= e($order['order_number']) ?></strong></td>
                        <td><?= format_date($order['created_at']) ?></td>
                        <td><?= format_money($order['total']) ?></td>
                        <td>
                            <span class="badge bg-<?= $order['status'] === 'completed' ? 'success' : ($order['status'] === 'confirmed' ? 'primary' : 'warning') ?>">
                                <?= ucfirst($order['status']) ?>
                            </span>
                        </td>
                        <td>
                            <a href="<?= base_url('minha-conta/voucher?code=' . $order['order_number']) ?>" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-ticket"></i> Voucher
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
