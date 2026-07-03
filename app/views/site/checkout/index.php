<?php ob_start(); ?>

<section class="py-5">
    <div class="container">
        <h1 class="fw-bold mb-4"><i class="bi bi-credit-card"></i> Checkout</h1>

        <div class="row g-4">
            <!-- Dados do Comprador -->
            <div class="col-lg-7">
                <form action="<?= base_url('checkout/processar') ?>" method="POST" id="checkoutForm">
                    <?= csrf_field() ?>

                    <!-- Dados pessoais -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Dados do Comprador</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nome Completo *</label>
                                    <input type="text" name="name" class="form-control" required 
                                        value="<?= e($_SESSION['user_name'] ?? '') ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control" required
                                        value="<?= e($_SESSION['user_email'] ?? '') ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Telefone / WhatsApp *</label>
                                    <input type="tel" name="phone" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Passageiros -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Passageiros</h5>
                            <div id="passengersList">
                                <div class="passenger-item border rounded p-3 mb-3">
                                    <h6 class="fw-semibold">Passageiro 1</h6>
                                    <div class="row g-2">
                                        <div class="col-md-5">
                                            <input type="text" name="passengers[0][name]" class="form-control form-control-sm" placeholder="Nome completo" required>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="email" name="passengers[0][email]" class="form-control form-control-sm" placeholder="Email">
                                        </div>
                                        <div class="col-md-3">
                                            <select name="passengers[0][age_group]" class="form-select form-select-sm">
                                                <option value="adult">Adulto</option>
                                                <option value="child">Criança</option>
                                                <option value="baby">Bebê</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="addPassenger()">
                                <i class="bi bi-plus"></i> Adicionar Passageiro
                            </button>
                        </div>
                    </div>

                    <!-- Termos -->
                    <?php if (site_config('checkout_terms_required', '1') === '1'): ?>
                    <div class="form-check mb-4">
                        <input type="checkbox" class="form-check-input" id="termsCheck" required>
                        <label class="form-check-label small" for="termsCheck">
                            Li e aceito os <a href="<?= base_url('termos-e-condicoes') ?>" target="_blank">Termos e Condições</a> 
                            e as <a href="<?= base_url('politicas-de-cancelamento') ?>" target="_blank">Políticas de Cancelamento</a>.
                        </label>
                    </div>
                    <?php endif; ?>

                    <!-- PayPal -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Pagamento</h5>
                            <div id="paypal-button-container"></div>
                            <input type="hidden" name="payment_id" id="paymentId">
                        </div>
                    </div>
                </form>
            </div>

            <!-- Resumo do Pedido -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm sticky-top" style="top:100px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Resumo do Pedido</h5>
                        <?php foreach ($cart as $item): ?>
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div>
                                <strong class="small"><?= e($item['name']) ?></strong>
                                <?php if ($item['date']): ?><br><small class="text-muted"><?= format_date($item['date']) ?></small><?php endif; ?>
                            </div>
                            <span class="fw-bold"><?= format_money($item['total_price']) ?></span>
                        </div>
                        <?php endforeach; ?>
                        <div class="d-flex justify-content-between mt-3 pt-3 border-top">
                            <span class="fw-bold fs-5">Total</span>
                            <span class="fw-bold fs-5 text-primary"><?= format_money($subtotal) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PayPal SDK -->
<?php if ($paypalClientId): ?>
<script src="https://www.paypal.com/sdk/js?client-id=<?= e($paypalClientId) ?>&currency=USD"></script>
<script>
paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{ amount: { value: '<?= number_format($subtotal, 2, '.', '') ?>' } }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            document.getElementById('paymentId').value = details.id;
            document.getElementById('checkoutForm').submit();
        });
    }
}).render('#paypal-button-container');
</script>
<?php endif; ?>

<script>
let passengerCount = 1;
function addPassenger() {
    passengerCount++;
    const html = `<div class="passenger-item border rounded p-3 mb-3">
        <h6 class="fw-semibold">Passageiro ${passengerCount}</h6>
        <div class="row g-2">
            <div class="col-md-5"><input type="text" name="passengers[${passengerCount-1}][name]" class="form-control form-control-sm" placeholder="Nome completo" required></div>
            <div class="col-md-4"><input type="email" name="passengers[${passengerCount-1}][email]" class="form-control form-control-sm" placeholder="Email"></div>
            <div class="col-md-3"><select name="passengers[${passengerCount-1}][age_group]" class="form-select form-select-sm"><option value="adult">Adulto</option><option value="child">Criança</option><option value="baby">Bebê</option></select></div>
        </div>
    </div>`;
    document.getElementById('passengersList').insertAdjacentHTML('beforeend', html);
}
</script>

<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
