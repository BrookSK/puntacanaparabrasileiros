<?php
/**
 * Controller de Passeios (público)
 */
class TourController extends Controller
{
    public function index()
    {
        // Buscar passeios do banco para injetar na página
        $tourModel = new TourModel($this->db);
        $tours = $tourModel->getAll(1, 50);
        
        // Disponibilizar para a view
        $GLOBALS['dynamic_tours'] = $tours;
        
        require_once VIEWS_PATH . '/site/experiencias-wp.php';
    }

    public function show($slug = '')
    {
        if (empty($slug)) {
            $slug = $this->input('slug', '');
        }

        $tourModel = new TourModel($this->db);
        $tour = $tourModel->findBySlug($slug);

        if (!$tour) {
            // Fallback: show the WP static page
            require_once VIEWS_PATH . '/site/passeio-detalhe-wp.php';
            return;
        }

        // Disponibilizar dados para a view estática
        $GLOBALS['current_tour'] = $tour;
        $GLOBALS['tour_packages'] = $tourModel->getPackages($tour['id']);
        $GLOBALS['tour_faqs'] = $tourModel->getFaq($tour['id']);
        $GLOBALS['tour_reviews'] = $tourModel->getReviews($tour['id']);

        // Usar o layout WP da single page
        require_once VIEWS_PATH . '/site/passeio-detalhe-wp.php';
    }

    public function showWp()
    {
        require_once VIEWS_PATH . '/site/passeio-detalhe-wp.php';
    }
}
