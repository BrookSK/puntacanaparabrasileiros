<?php
/**
 * Router - Sistema de roteamento
 */
class Router
{
    private $controller = 'HomeController';
    private $method = 'index';
    private $params = [];

    public function dispatch()
    {
        $url = $this->parseUrl();

        // Rotas do Admin
        if (isset($url[0]) && $url[0] === 'admin') {
            $this->handleAdminRoutes($url);
            return;
        }

        // Rotas públicas
        $this->handlePublicRoutes($url);
    }

    private function handlePublicRoutes($url)
    {
        $routes = [
            '' => ['HomeController', 'index'],
            'sobre-nos' => ['HomeController', 'sobreNos'],
            'contato' => ['HomeController', 'contato'],
            'contato/enviar' => ['HomeController', 'enviarContato'],
            'experiencias' => ['TourController', 'index'],
            'passeios' => ['TourController', 'index'],
            'passeio' => ['TourController', 'show'],
            'trip' => ['TourController', 'showWp'],
            'transfer' => ['TransferController', 'index'],
            'transfer/buscar' => ['TransferController', 'search'],
            'blog' => ['BlogController', 'index'],
            'blog/post' => ['BlogController', 'show'],
            'carrinho' => ['CartController', 'index'],
            'carrinho/adicionar' => ['CartController', 'add'],
            'carrinho/remover' => ['CartController', 'remove'],
            'checkout' => ['CheckoutController', 'index'],
            'checkout/processar' => ['CheckoutController', 'process'],
            'login' => ['AuthController', 'login'],
            'login/autenticar' => ['AuthController', 'authenticate'],
            'registro' => ['AuthController', 'register'],
            'registro/criar' => ['AuthController', 'store'],
            'logout' => ['AuthController', 'logout'],
            'minha-conta' => ['AccountController', 'index'],
            'minha-conta/pedidos' => ['AccountController', 'orders'],
            'minha-conta/voucher' => ['AccountController', 'voucher'],
            'programa-de-afiliados' => ['AffiliateController', 'index'],
            'conta-de-afiliado' => ['AffiliateController', 'dashboard'],
            'lista-de-desejos' => ['WishlistController', 'index'],
            'busca' => ['SearchController', 'index'],
            'politicas-de-privacidade' => ['PageController', 'privacidade'],
            'politicas-de-cancelamento' => ['PageController', 'cancelamento'],
            'termos-e-condicoes' => ['PageController', 'termos'],
            'termos-e-condicoes-do-programa-de-afiliados' => ['PageController', 'termosAfiliados'],
            'cancelamentos' => ['PageController', 'cancelamentos'],
        ];

        $path = implode('/', $url);

        if (isset($routes[$path])) {
            $this->controller = $routes[$path][0];
            $this->method = $routes[$path][1];
        } elseif (isset($url[0])) {
            // Tentar encontrar rota dinâmica
            $controllerName = ucfirst($url[0]) . 'Controller';
            if (file_exists(APP_PATH . '/controllers/' . $controllerName . '.php')) {
                $this->controller = $controllerName;
                array_shift($url);
                if (isset($url[0])) {
                    $this->method = $url[0];
                    array_shift($url);
                }
            }
            $this->params = $url;
        }

        // Instanciar e chamar
        if (file_exists(APP_PATH . '/controllers/' . $this->controller . '.php')) {
            $controller = new $this->controller();
            if (method_exists($controller, $this->method)) {
                call_user_func_array([$controller, $this->method], $this->params);
            } else {
                $this->show404();
            }
        } else {
            $this->show404();
        }
    }

    private function handleAdminRoutes($url)
    {
        array_shift($url); // Remove 'admin'

        $routes = [
            '' => ['Admin\\DashboardController', 'index'],
            'login' => ['Admin\\AuthController', 'login'],
            'login/autenticar' => ['Admin\\AuthController', 'authenticate'],
            'logout' => ['Admin\\AuthController', 'logout'],
            'configuracoes' => ['Admin\\ConfigController', 'index'],
            'configuracoes/salvar' => ['Admin\\ConfigController', 'save'],
            'passeios' => ['Admin\\TourAdminController', 'index'],
            'passeios/criar' => ['Admin\\TourAdminController', 'create'],
            'passeios/salvar' => ['Admin\\TourAdminController', 'store'],
            'passeios/editar' => ['Admin\\TourAdminController', 'edit'],
            'passeios/atualizar' => ['Admin\\TourAdminController', 'update'],
            'passeios/excluir' => ['Admin\\TourAdminController', 'delete'],
            'transfers' => ['Admin\\TransferAdminController', 'index'],
            'transfers/criar' => ['Admin\\TransferAdminController', 'create'],
            'transfers/salvar' => ['Admin\\TransferAdminController', 'store'],
            'transfers/editar' => ['Admin\\TransferAdminController', 'edit'],
            'transfers/atualizar' => ['Admin\\TransferAdminController', 'update'],
            'transfers/excluir' => ['Admin\\TransferAdminController', 'delete'],
            'blog' => ['Admin\\BlogAdminController', 'index'],
            'blog/criar' => ['Admin\\BlogAdminController', 'create'],
            'blog/salvar' => ['Admin\\BlogAdminController', 'store'],
            'blog/editar' => ['Admin\\BlogAdminController', 'edit'],
            'blog/atualizar' => ['Admin\\BlogAdminController', 'update'],
            'blog/excluir' => ['Admin\\BlogAdminController', 'delete'],
            'usuarios' => ['Admin\\UserAdminController', 'index'],
            'usuarios/criar' => ['Admin\\UserAdminController', 'create'],
            'usuarios/salvar' => ['Admin\\UserAdminController', 'store'],
            'usuarios/editar' => ['Admin\\UserAdminController', 'edit'],
            'usuarios/atualizar' => ['Admin\\UserAdminController', 'update'],
            'usuarios/excluir' => ['Admin\\UserAdminController', 'delete'],
            'pedidos' => ['Admin\\OrderAdminController', 'index'],
            'pedidos/ver' => ['Admin\\OrderAdminController', 'show'],
            'pedidos/atualizar-status' => ['Admin\\OrderAdminController', 'updateStatus'],
            'afiliados' => ['Admin\\AffiliateAdminController', 'index'],
            'afiliados/aprovar' => ['Admin\\AffiliateAdminController', 'approve'],
            'afiliados/pagar' => ['Admin\\AffiliateAdminController', 'pay'],
        ];

        $path = implode('/', $url);

        $controllerName = '';
        $methodName = '';

        if (isset($routes[$path])) {
            $controllerName = $routes[$path][0];
            $methodName = $routes[$path][1];
        } else {
            $this->show404();
            return;
        }

        // Para controllers do admin, o namespace é diferente
        $controllerFile = str_replace('Admin\\', '', $controllerName);
        $filePath = APP_PATH . '/controllers/admin/' . $controllerFile . '.php';

        if (file_exists($filePath)) {
            require_once $filePath;
            $controller = new $controllerName();
            if (method_exists($controller, $methodName)) {
                call_user_func_array([$controller, $methodName], array_values($url));
            } else {
                $this->show404();
            }
        } else {
            $this->show404();
        }
    }

    private function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }

    private function show404()
    {
        http_response_code(404);
        require_once VIEWS_PATH . '/errors/404.php';
        exit;
    }
}
