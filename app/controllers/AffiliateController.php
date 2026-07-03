<?php
/**
 * Controller de Afiliados (público + dashboard)
 */
class AffiliateController extends Controller
{
    public function index()
    {
        $this->view('site.affiliate.index', [
            'pageTitle' => 'Programa de Afiliados - Punta Cana para Brasileiros',
        ]);
    }

    public function dashboard()
    {
        $this->requireAuth();

        $userId = $_SESSION['user_id'];

        // Buscar dados do afiliado
        $stmt = $this->db->prepare("SELECT * FROM affiliates WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $userId]);
        $affiliate = $stmt->fetch();

        if (!$affiliate) {
            // Redirecionar para página de cadastro de afiliado
            $this->view('site.affiliate.register', [
                'pageTitle' => 'Tornar-se Afiliado',
            ]);
            return;
        }

        // Buscar comissões
        $stmt = $this->db->prepare(
            "SELECT ac.*, o.order_number, o.total as order_total 
             FROM affiliate_commissions ac
             JOIN orders o ON ac.order_id = o.id
             WHERE ac.affiliate_id = :affiliate_id
             ORDER BY ac.created_at DESC LIMIT 20"
        );
        $stmt->execute([':affiliate_id' => $affiliate['id']]);
        $commissions = $stmt->fetchAll();

        $affiliateLink = base_url('?ref=' . $affiliate['affiliate_code']);

        $this->view('site.affiliate.dashboard', [
            'pageTitle' => 'Painel de Afiliado',
            'affiliate' => $affiliate,
            'commissions' => $commissions,
            'affiliateLink' => $affiliateLink,
        ]);
    }
}
