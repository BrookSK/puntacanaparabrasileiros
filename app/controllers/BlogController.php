<?php
/**
 * Controller do Blog (público)
 */
class BlogController extends Controller
{
    public function index()
    {
        $blogModel = new BlogModel($this->db);
        $page = (int)($this->input('page', 1));
        $category = $this->input('category');

        $posts = $blogModel->getAll($page, 9, $category);
        $totalPosts = $blogModel->count($category);
        $totalPages = ceil($totalPosts / 9);
        $categories = $blogModel->getCategories();

        $this->view('site.blog.index', [
            'pageTitle' => 'Blog - Punta Cana para Brasileiros',
            'posts' => $posts,
            'categories' => $categories,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'currentCategory' => $category,
        ]);
    }

    public function show($slug = '')
    {
        if (empty($slug)) {
            $slug = $this->input('slug', '');
        }

        $blogModel = new BlogModel($this->db);
        $post = $blogModel->findBySlug($slug);

        if (!$post) {
            http_response_code(404);
            require_once VIEWS_PATH . '/errors/404.php';
            return;
        }

        $recentPosts = $blogModel->getRecent(5);

        $this->view('site.blog.show', [
            'pageTitle' => $post['title'] . ' - Blog',
            'post' => $post,
            'recentPosts' => $recentPosts,
        ]);
    }
}
