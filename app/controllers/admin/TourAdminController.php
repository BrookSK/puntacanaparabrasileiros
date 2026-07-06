<?php
namespace Admin;

/**
 * Controller Admin de Passeios
 */
class TourAdminController extends \Controller
{
    public function index()
    {
        $this->requireAdmin();
        $tourModel = new \TourModel($this->db);
        $page = (int)($this->input('page', 1));

        $stmt = $this->db->query("SELECT t.*, c.name as category_name FROM tours t LEFT JOIN tour_categories c ON t.category_id = c.id WHERE t.status != 'deleted' ORDER BY t.created_at DESC");
        $tours = $stmt->fetchAll();

        $this->view('admin.tours.index', [
            'pageTitle' => 'Gerenciar Passeios',
            'tours' => $tours,
        ]);
    }

    public function create()
    {
        $this->requireAdmin();
        $stmt = $this->db->query("SELECT * FROM tour_categories WHERE status = 'active' ORDER BY name");
        $categories = $stmt->fetchAll();

        $this->view('admin.tours.form', [
            'pageTitle' => 'Novo Passeio',
            'tour' => null,
            'categories' => $categories,
        ]);
    }

    public function store()
    {
        $this->requireAdmin();
        if (!$this->isPost()) { $this->redirect('admin/passeios'); return; }
        if (!verify_csrf($this->input('csrf_token'))) { flash('error', 'Token inválido.'); $this->redirect('admin/passeios/criar'); return; }

        $name = trim($this->input('name', ''));
        $slug = slugify($name);

        $tourModel = new \TourModel($this->db);
        $tourModel->create([
            ':name' => $name,
            ':slug' => $slug,
            ':description' => $this->input('description', ''),
            ':overview' => $this->input('overview', ''),
            ':highlights' => $this->input('highlights', ''),
            ':inclusions' => $this->input('inclusions', ''),
            ':exclusions' => $this->input('exclusions', ''),
            ':what_to_bring' => $this->input('what_to_bring', ''),
            ':restrictions' => $this->input('restrictions', ''),
            ':pregnant_allowed' => $this->input('pregnant_allowed', 1),
            ':duration_hours' => $this->input('duration_hours', 0),
            ':duration_days' => $this->input('duration_days', 0),
            ':price_from' => $this->input('price_from', 0),
            ':discount_percent' => $this->input('discount_percent', 0),
            ':category_id' => $this->input('category_id') ?: null,
            ':activity_type' => $this->input('activity_type', ''),
            ':featured' => $this->input('featured', 0),
            ':sort_order' => $this->input('sort_order', 0),
            ':status' => $this->input('status', 'active'),
            ':image_url' => $this->input('image_url', ''),
            ':gallery' => $this->input('gallery', '[]'),
        ]);

        flash('success', 'Passeio criado com sucesso!');
        $this->redirect('admin/passeios');
    }

    public function edit()
    {
        $this->requireAdmin();
        $id = (int)($this->input('id', 0) ?: ($_GET['id'] ?? 0));
        $tourModel = new \TourModel($this->db);
        $tour = $tourModel->findById($id);

        if (!$tour) { flash('error', 'Passeio não encontrado.'); $this->redirect('admin/passeios'); return; }

        $stmt = $this->db->query("SELECT * FROM tour_categories WHERE status = 'active' ORDER BY name");
        $categories = $stmt->fetchAll();

        $packages = $tourModel->getPackages($id);
        foreach ($packages as &$pkg) { $pkg['age_groups'] = $tourModel->getAgeGroups($pkg['id']); }

        $faqs = $tourModel->getFaq($id);
        $documents = $tourModel->getDocuments($id);

        $this->view('admin.tours.form', [
            'pageTitle' => 'Editar: ' . $tour['name'],
            'tour' => $tour,
            'categories' => $categories,
            'packages' => $packages,
            'faqs' => $faqs,
            'documents' => $documents,
        ]);
    }

    public function update()
    {
        $this->requireAdmin();
        if (!$this->isPost()) { $this->redirect('admin/passeios'); return; }
        if (!verify_csrf($this->input('csrf_token'))) { flash('error', 'Token inválido.'); $this->redirect('admin/passeios'); return; }

        $id = (int)($this->input('id', 0));
        if (!$id) { $this->redirect('admin/passeios'); return; }

        $name = trim($this->input('name', ''));
        $slug = slugify($name);

        $tourModel = new \TourModel($this->db);
        $tourModel->update($id, [
            ':name' => $name,
            ':slug' => $slug,
            ':description' => $this->input('description', ''),
            ':overview' => $this->input('overview', ''),
            ':highlights' => $this->input('highlights', ''),
            ':inclusions' => $this->input('inclusions', ''),
            ':exclusions' => $this->input('exclusions', ''),
            ':what_to_bring' => $this->input('what_to_bring', ''),
            ':restrictions' => $this->input('restrictions', ''),
            ':pregnant_allowed' => $this->input('pregnant_allowed', 1),
            ':duration_hours' => $this->input('duration_hours', 0),
            ':duration_days' => $this->input('duration_days', 0),
            ':price_from' => $this->input('price_from', 0),
            ':discount_percent' => $this->input('discount_percent', 0),
            ':category_id' => $this->input('category_id') ?: null,
            ':activity_type' => $this->input('activity_type', ''),
            ':featured' => $this->input('featured', 0),
            ':sort_order' => $this->input('sort_order', 0),
            ':status' => $this->input('status', 'active'),
            ':image_url' => $this->input('image_url', ''),
            ':gallery' => $this->input('gallery', '[]'),
        ]);

        flash('success', 'Passeio atualizado com sucesso!');
        $this->redirect('admin/passeios');
    }

    public function delete()
    {
        $this->requireAdmin();
        $id = (int)($this->input('id', 0));
        $tourModel = new \TourModel($this->db);
        $tourModel->delete($id);
        flash('success', 'Passeio removido.');
        $this->redirect('admin/passeios');
    }
}
