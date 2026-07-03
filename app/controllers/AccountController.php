<?php
/**
 * Controller da Conta do Cliente
 */
class AccountController extends Controller
{
    public function index()
    {
        $this->requireAuth();

        $userModel = new UserModel($this->db);
        $user = $userModel->findById($_SESSION['user_id']);

        $this->view('site.account.index', [
            'pageTitle' => 'Minha Conta',
            'user' => $user,
        ]);
    }

    public function orders()
    {
        $this->requireAuth();

        $stmt = $this->db->prepare(
            "SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC"
        );
        $stmt->execute([':user_id' => $_SESSION['user_id']]);
        $orders = $stmt->fetchAll();

        $this->view('site.account.orders', [
            'pageTitle' => 'Meus Pedidos',
            'orders' => $orders,
        ]);
    }

    public function voucher()
    {
        $this->requireAuth();

        $voucherCode = $this->input('code', '');

        $stmt = $this->db->prepare(
            "SELECT v.*, o.order_number, o.user_id, oi.item_name, oi.package_name,
                    oi.date, oi.time_slot, oi.adults, oi.children, oi.babies, oi.total_price
             FROM vouchers v
             JOIN orders o ON v.order_id = o.id
             JOIN order_items oi ON v.order_item_id = oi.id
             WHERE v.voucher_code = :code AND o.user_id = :user_id"
        );
        $stmt->execute([':code' => $voucherCode, ':user_id' => $_SESSION['user_id']]);
        $voucher = $stmt->fetch();

        if (!$voucher) {
            flash('error', 'Voucher não encontrado.');
            $this->redirect('minha-conta/pedidos');
            return;
        }

        // Buscar passageiros
        $stmt = $this->db->prepare(
            "SELECT * FROM order_passengers WHERE order_id = :order_id"
        );
        $stmt->execute([':order_id' => $voucher['order_id']]);
        $passengers = $stmt->fetchAll();

        $this->view('site.account.voucher', [
            'pageTitle' => 'Voucher - ' . $voucher['voucher_code'],
            'voucher' => $voucher,
            'passengers' => $passengers,
        ]);
    }
}
