<?php
/**
 * Controller de Lista de Desejos
 */
class WishlistController extends Controller
{
    public function index()
    {
        $this->requireAuth();

        $stmt = $this->db->prepare(
            "SELECT t.* FROM wishlists w 
             JOIN tours t ON w.tour_id = t.id 
             WHERE w.user_id = :user_id AND t.status = 'active'
             ORDER BY w.created_at DESC"
        );
        $stmt->execute([':user_id' => $_SESSION['user_id']]);
        $tours = $stmt->fetchAll();

        $this->wpView('site/wishlist', [
            'pageTitle' => 'Lista de Desejos',
            'tours' => $tours,
        ]);
    }
}
