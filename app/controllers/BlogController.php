<?php
/**
 * Controller do Blog (público)
 */
class BlogController extends Controller
{
    public function index()
    {
        // Servir o HTML original do WordPress para o blog
        require_once VIEWS_PATH . '/site/blog-wp.php';
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

        $this->wpView('site/blog/show', [
            'pageTitle' => $post['title'] . ' - Blog',
            'post' => $post,
            'recentPosts' => $recentPosts,
        ]);
    }
}
