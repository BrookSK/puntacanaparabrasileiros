<?php ob_start(); ?>
<section class="py-5">
    <div class="container">
        <h1 class="fw-bold mb-4"><i class="bi bi-share"></i> Painel de Afiliado</h1>
        <div class="row g-4 mb-4">
            <div class="col-md-3"><div class="card border-0 shadow-sm p-3 text-center"><p class="text-muted small mb-0">Total Ganho</p><h3 class="fw-bold text-success"><?= format_money($affiliate['total_earned']) ?></h3></div></div>
            <div class="col-md-3"><div class="card border-0 shadow-sm p-3 text-center"><p class="text-muted small mb-0">Total Pago</p><h3 class="fw-bold"><?= format_money($affiliate['total_paid']) ?></h3></div></div>
            <div class="col-md-3"><div class="card border-0 shadow-sm p-3 text-center"><p class="text-muted small mb-0">Saldo</p><h3 class="fw-bold text-primary"><?= format_money($affiliate['balance']) ?></h3></div></div>
            <div class="col-md-3"><div class="card border-0 shadow-sm p-3 text-center"><p class="text-muted small mb-0">Comissão</p><h3 class="fw-bold"><?= $affiliate['commission_percent'] ?>%</h3></div></div>
        </div>
        <div class="card border-0 shadow-sm p-4 mb-4">
            <h5 class="fw-bold">Seu Link de Afiliado</h5>
            <div class="input-group">
                <input type="text" class="form-control" value="<?= e($affiliateLink) ?>" id="affiliateLink" readonly>
                <button class="btn btn-primary" onclick="navigator.clipboard.writeText(document.getElementById('affiliateLink').value)"><i class="bi bi-clipboard"></i> Copiar</button>
            </div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Comissões Recentes</h5>
                <?php if (empty($commissions)): ?>
                <p class="text-muted">Nenhuma comissão ainda.</p>
                <?php else: ?>
                <table class="table"><thead><tr><th>Pedido</th><th>Valor</th><th>Comissão</th><th>Status</th><th>Data</th></tr></thead><tbody>
                <?php foreach ($commissions as $c): ?>
                <tr><td><?= e($c['order_number']) ?></td><td><?= format_money($c['order_total']) ?></td><td class="text-success"><?= format_money($c['amount']) ?></td><td><span class="badge bg-<?= $c['status'] === 'paid' ? 'success' : 'warning' ?>"><?= ucfirst($c['status']) ?></span></td><td><?= format_date($c['created_at']) ?></td></tr>
                <?php endforeach; ?>
                </tbody></table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
