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

        $this->wpView('site/tours/show', [
            'pageTitle' => $tour['name'] . ' - Punta Cana para Brasileiros',
            'tour' => $tour,
            'packages' => $packages,
            'faqs' => $faqs,
            'reviews' => $reviews,
            'documents' => $documents,
            'relatedTours' => $relatedTours,
        ]);
    }

    public function showWp()
    {
        require_once VIEWS_PATH . '/site/passeio-detalhe-wp.php';
    }
}
