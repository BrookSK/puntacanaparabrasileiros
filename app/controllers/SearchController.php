<?php
/**
 * Controller de Busca
 */
class SearchController extends Controller
{
    public function index()
    {
        $query = trim($this->input('q', ''));
        $results = [];

        if (!empty($query)) {
            // Buscar passeios
            $stmt = $this->db->prepare(
                "SELECT id, name, slug, description, image_url, price_from, 'tour' as type 
                 FROM tours 
                 WHERE status = 'active' AND (name LIKE :q1 OR description LIKE :q2)
                 LIMIT 10"
            );
            $stmt->execute([':q1' => "%{$query}%", ':q2' => "%{$query}%"]);
            $results = array_merge($results, $stmt->fetchAll());

            // Buscar posts do blog
            $stmt = $this->db->prepare(
                "SELECT id, title as name, slug, excerpt as description, image_url, 0 as price_from, 'blog' as type
                 FROM blog_posts 
                 WHERE status = 'published' AND (title LIKE :q1 OR content LIKE :q2)
                 LIMIT 5"
            );
            $stmt->execute([':q1' => "%{$query}%", ':q2' => "%{$query}%"]);
            $results = array_merge($results, $stmt->fetchAll());
        }

        $this->view('site.search', [
            'pageTitle' => 'Busca - Punta Cana para Brasileiros',
            'query' => $query,
            'results' => $results,
        ]);
    }
}
