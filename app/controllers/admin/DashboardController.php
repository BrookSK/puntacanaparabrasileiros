<?php
namespace Admin;

/**
 * Controller do Dashboard Admin
 */
class DashboardController extends \Controller
{
    public function index()
    {
        $this->requireAdmin();

        // Estatísticas
        $userModel = new \UserModel($this->db);
        $totalClients = $userModel->count('client');
        $totalAffiliates = $userModel->count('affiliate');

        // Pedidos recentes
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM orders WHERE status = 'pending'");
        $pendingOrders = $stmt->fetch()['total'] ?? 0;

        $stmt = $this->db->query("SELECT COALESCE(SUM(total), 0) as revenue FROM orders WHERE status = 'completed' AND MONTH(created_at) = MONTH(NOW())");
        $monthlyRevenue = $stmt->fetch()['revenue'] ?? 0;

        $this->view('admin.dashboard', [
            'pageTitle' => 'Dashboard - Admin',
            'totalClients' => $totalClients,
            'totalAffiliates' => $totalAffiliates,
            'pendingOrders' => $pendingOrders,
            'monthlyRevenue' => $monthlyRevenue,
        ]);
    }
}
