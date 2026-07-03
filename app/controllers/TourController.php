<?php
/**
 * Controller de Passeios (público)
 */
class TourController extends Controller
{
    public function index()
    {
        $tourModel = new TourModel($this->db);

        $page = (int)($this->input('page', 1));
        $filters = [
            'category' => $this->input('category'),
            'activity_type' => $this->input('activity'),
            'duration_days' => $this->input('days'),
            'price_min' => $this->input('price_min'),
            'price_max' => $this->input('price_max'),
            'search' => $this->input('q'),
        ];

        $tours = $tourModel->getAll($page, 12, $filters);
        $totalTours = $tourModel->count($filters);
        $totalPages = ceil($totalTours / 12);

        // Buscar categorias para filtros
        $stmt = $this->db->query("SELECT * FROM tour_categories WHERE status = 'active' ORDER BY sort_order");
        $categories = $stmt->fetchAll();

        $this->view('site.tours.index', [
            'pageTitle' => 'Passeios e Experiências - Punta Cana para Brasileiros',
            'tours' => $tours,
            'categories' => $categories,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'filters' => $filters,
        ]);
    }

    public function show($slug = '')
    {
        if (empty($slug)) {
            $slug = $this->input('slug', '');
        }

        $tourModel = new TourModel($this->db);
        $tour = $tourModel->findBySlug($slug);

        if (!$tour) {
            http_response_code(404);
            require_once VIEWS_PATH . '/errors/404.php';
            return;
        }

        // Buscar dados relacionados
        $packages = $tourModel->getPackages($tour['id']);
        $faqs = $tourModel->getFaq($tour['id']);
        $reviews = $tourModel->getReviews($tour['id']);
        $documents = $tourModel->getDocuments($tour['id']);
        $relatedTours = $tourModel->getRelated($tour['id'], $tour['category_id']);

        // Buscar faixas etárias de cada pacote
        foreach ($packages as &$package) {
            $package['age_groups'] = $tourModel->getAgeGroups($package['id']);
        }

        $this->view('site.tours.show', [
            'pageTitle' => $tour['name'] . ' - Punta Cana para Brasileiros',
            'tour' => $tour,
            'packages' => $packages,
            'faqs' => $faqs,
            'reviews' => $reviews,
            'documents' => $documents,
            'relatedTours' => $relatedTours,
        ]);
    }
}
