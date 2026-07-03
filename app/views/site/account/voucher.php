<?php ob_start(); ?>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow" id="voucherCard">
                    <div class="card-body p-5">
                        <!-- Header do Voucher -->
                        <div class="text-center border-bottom pb-4 mb-4">
                            <?php if (site_config('voucher_logo_url')): ?>
                            <img src="<?= e(site_config('voucher_logo_url')) ?>" height="60" class="mb-3">
                            <?php else: ?>
                            <h3 class="fw-bold text-primary">Punta Cana para Brasileiros</h3>
                            <?php endif; ?>
                            <h4 class="fw-bold">VOUCHER DE CONFIRMAÇÃO</h4>
                            <span class="badge bg-success fs-6"><?= e($voucher['voucher_code']) ?></span>
                        </div>

                        <!-- Detalhes -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <strong>Pedido:</strong> <?= e($voucher['order_number']) ?>
                            </div>
                            <div class="col-md-6">
                                <strong>Status:</strong> 
                                <span class="badge bg-<?= $voucher['status'] === 'active' ? 'success' : 'secondary' ?>">
                                    <?= ucfirst($voucher['status']) ?>
                                </span>
                            </div>
                        </div>

                        <div class="card bg-light border-0 p-3 mb-4">
                            <h5 class="fw-bold"><?= e($voucher['item_name']) ?></h5>
                            <?php if ($voucher['package_name']): ?>
                            <p class="mb-1"><strong>Pacote:</strong> <?= e($voucher['package_name']) ?></p>
                            <?php endif; ?>
                            <?php if ($voucher['date']): ?>
                            <p class="mb-1"><strong>Data:</strong> <?= format_date($voucher['date']) ?></p>
                            <?php endif; ?>
                            <?php if ($voucher['time_slot']): ?>
                            <p class="mb-1"><strong>Horário:</strong> <?= e($voucher['time_slot']) ?></p>
                            <?php endif; ?>
                            <p class="mb-1"><strong>Adultos:</strong> <?= $voucher['adults'] ?> | <strong>Crianças:</strong> <?= $voucher['children'] ?> | <strong>Bebês:</strong> <?= $voucher['babies'] ?></p>
                            <p class="mb-0"><strong>Valor:</strong> <?= format_money($voucher['total_price']) ?></p>
                        </div>

                        <!-- Passageiros -->
                        <?php if (!empty($passengers)): ?>
                        <h6 class="fw-bold">Passageiros:</h6>
                        <ul class="list-group list-group-flush mb-4">
                            <?php foreach ($passengers as $p): ?>
                            <li class="list-group-item px-0"><?= e($p['name']) ?> (<?= e($p['age_group']) ?>)</li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <!-- Footer -->
                        <div class="text-center border-top pt-4 text-muted small">
                            <p><?= e(site_config('voucher_footer_text', 'Obrigado pela preferência!')) ?></p>
                            <p><?= e(site_config('voucher_contact_info', 'WhatsApp: +1 (829) 458-2170')) ?></p>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button class="btn btn-primary" onclick="window.print()"><i class="bi bi-printer"></i> Imprimir Voucher</button>
                    <a href="<?= base_url('minha-conta/pedidos') ?>" class="btn btn-outline-secondary">Voltar aos Pedidos</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
