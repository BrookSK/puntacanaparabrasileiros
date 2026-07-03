<?php
/**
 * Controller de Checkout
 */
class CheckoutController extends Controller
{
    public function index()
    {
        $cart = $_SESSION['cart'] ?? [];

        if (empty($cart)) {
            flash('error', 'Seu carrinho está vazio.');
            $this->redirect('experiencias');
            return;
        }

        // Se checkout requer login
        if (site_config('checkout_guest_enabled', '0') === '0' && !$this->isLoggedIn()) {
            flash('error', 'Faça login para finalizar a compra.');
            $this->redirect('login');
            return;
        }

        $subtotal = array_sum(array_column($cart, 'total_price'));

        $this->wpView('site/checkout/index', [
            'pageTitle' => 'Checkout - Punta Cana para Brasileiros',
            'cart' => $cart,
            'subtotal' => $subtotal,
            'paypalClientId' => site_config('paypal_client_id'),
            'paypalMode' => site_config('paypal_mode', 'sandbox'),
        ]);
    }

    public function process()
    {
        if (!$this->isPost()) {
            $this->redirect('checkout');
            return;
        }

        if (!verify_csrf($this->input('csrf_token'))) {
            flash('error', 'Token de segurança inválido.');
            $this->redirect('checkout');
            return;
        }

        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart)) {
            $this->redirect('experiencias');
            return;
        }

        $paymentId = $this->input('payment_id', '');
        $subtotal = array_sum(array_column($cart, 'total_price'));

        // Verificar afiliado
        $affiliateId = $_SESSION['affiliate_ref'] ?? null;
        $affiliateCommission = 0;

        if ($affiliateId) {
            $commissionPercent = (float)site_config('affiliate_commission_percent', '10');
            $affiliateCommission = $subtotal * ($commissionPercent / 100);
        }

        // Gerar número do pedido
        $orderNumber = 'PCB-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5));

        // Criar pedido
        $stmt = $this->db->prepare(
            "INSERT INTO orders (order_number, user_id, guest_name, guest_email, guest_phone, 
             subtotal, discount, total, currency, status, payment_method, payment_id, payment_status,
             affiliate_id, affiliate_commission, created_at)
             VALUES (:order_number, :user_id, :guest_name, :guest_email, :guest_phone,
             :subtotal, 0, :total, 'USD', 'confirmed', 'paypal', :payment_id, 'paid',
             :affiliate_id, :affiliate_commission, NOW())"
        );

        $stmt->execute([
            ':order_number' => $orderNumber,
            ':user_id' => $_SESSION['user_id'] ?? null,
            ':guest_name' => $this->input('name', ''),
            ':guest_email' => $this->input('email', ''),
            ':guest_phone' => $this->input('phone', ''),
            ':subtotal' => $subtotal,
            ':total' => $subtotal,
            ':payment_id' => $paymentId,
            ':affiliate_id' => $affiliateId,
            ':affiliate_commission' => $affiliateCommission,
        ]);

        $orderId = $this->db->lastInsertId();

        // Inserir itens do pedido
        foreach ($cart as $item) {
            $stmt = $this->db->prepare(
                "INSERT INTO order_items (order_id, item_type, item_id, item_name, package_name,
                 date, time_slot, adults, children, babies, quantity, unit_price, total_price)
                 VALUES (:order_id, :item_type, :item_id, :item_name, :package_name,
                 :date, :time_slot, :adults, :children, :babies, 1, :unit_price, :total_price)"
            );
            $stmt->execute([
                ':order_id' => $orderId,
                ':item_type' => $item['item_type'],
                ':item_id' => $item['item_id'],
                ':item_name' => $item['name'],
                ':package_name' => $item['package_name'] ?? '',
                ':date' => $item['date'] ?? null,
                ':time_slot' => $item['time_slot'] ?? null,
                ':adults' => $item['adults'] ?? 0,
                ':children' => $item['children'] ?? 0,
                ':babies' => $item['babies'] ?? 0,
                ':unit_price' => $item['unit_price'],
                ':total_price' => $item['total_price'],
            ]);

            $orderItemId = $this->db->lastInsertId();

            // Gerar voucher para cada item
            $voucherCode = 'V-' . strtoupper(substr(md5($orderId . $orderItemId . time()), 0, 8));
            $stmt = $this->db->prepare(
                "INSERT INTO vouchers (order_id, order_item_id, voucher_code, status, created_at)
                 VALUES (:order_id, :order_item_id, :voucher_code, 'active', NOW())"
            );
            $stmt->execute([
                ':order_id' => $orderId,
                ':order_item_id' => $orderItemId,
                ':voucher_code' => $voucherCode,
            ]);
        }

        // Inserir passageiros
        $passengers = $this->input('passengers', []);
        if (is_array($passengers)) {
            foreach ($passengers as $passenger) {
                $stmt = $this->db->prepare(
                    "INSERT INTO order_passengers (order_id, order_item_id, name, email, phone, age_group)
                     VALUES (:order_id, :order_item_id, :name, :email, :phone, :age_group)"
                );
                $stmt->execute([
                    ':order_id' => $orderId,
                    ':order_item_id' => $passenger['order_item_id'] ?? $orderId,
                    ':name' => $passenger['name'] ?? '',
                    ':email' => $passenger['email'] ?? '',
                    ':phone' => $passenger['phone'] ?? '',
                    ':age_group' => $passenger['age_group'] ?? 'adult',
                ]);
            }
        }

        // Registrar comissão de afiliado
        if ($affiliateId && $affiliateCommission > 0) {
            $stmt = $this->db->prepare(
                "INSERT INTO affiliate_commissions (affiliate_id, order_id, amount, status, created_at)
                 VALUES (:affiliate_id, :order_id, :amount, 'pending', NOW())"
            );
            $stmt->execute([
                ':affiliate_id' => $affiliateId,
                ':order_id' => $orderId,
                ':amount' => $affiliateCommission,
            ]);

            // Atualizar balanço do afiliado
            $stmt = $this->db->prepare(
                "UPDATE affiliates SET total_earned = total_earned + :amount, balance = balance + :amount2 WHERE id = :id"
            );
            $stmt->execute([':amount' => $affiliateCommission, ':amount2' => $affiliateCommission, ':id' => $affiliateId]);
        }

        // Limpar carrinho
        $_SESSION['cart'] = [];
        unset($_SESSION['affiliate_ref']);

        flash('success', 'Compra realizada com sucesso! Seu número de pedido é: ' . $orderNumber);
        $this->redirect('minha-conta/pedidos');
    }
}
