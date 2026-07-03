<?php
/**
 * Controller base
 */
class Controller
{
    protected $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    protected function view($view, $data = [])
    {
        extract($data);
        $viewFile = VIEWS_PATH . '/' . str_replace('.', '/', $view) . '.php';
        
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View não encontrada: " . $view);
        }
    }

    protected function wpView($viewFile, $data = [])
    {
        extract($data);
        $viewPath = VIEWS_PATH . '/' . str_replace('.', '/', $viewFile) . '.php';

        if (!file_exists($viewPath)) {
            die("View não encontrada: " . $viewFile);
        }

        ob_start();
        require $viewPath;
        $content = ob_get_clean();

        require_once VIEWS_PATH . '/layouts/wp-layout.php';
    }

    protected function redirect($url)
    {
        header("Location: /" . ltrim($url, '/'));
        exit;
    }

    protected function json($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function input($key, $default = null)
    {
        return $_POST[$key] ?? $_GET[$key] ?? $default;
    }

    protected function config($key, $default = '')
    {
        return $GLOBALS['site_config'][$key] ?? $default;
    }

    protected function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    protected function isAdmin()
    {
        return isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], ['superadmin', 'admin', 'support']);
    }

    protected function isSuperAdmin()
    {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'superadmin';
    }

    protected function requireAuth()
    {
        if (!$this->isLoggedIn()) {
            $this->redirect('login');
        }
    }

    protected function requireAdmin()
    {
        if (!$this->isAdmin()) {
            $this->redirect('admin/login');
        }
    }

    protected function requireSuperAdmin()
    {
        if (!$this->isSuperAdmin()) {
            $this->redirect('admin/login');
        }
    }
}
