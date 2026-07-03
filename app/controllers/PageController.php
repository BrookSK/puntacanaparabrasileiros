<?php
/**
 * Controller de Páginas estáticas (políticas, termos, etc)
 * Serve o HTML original do WordPress
 */
class PageController extends Controller
{
    public function privacidade()
    {
        require_once VIEWS_PATH . '/site/privacidade-wp.php';
    }

    public function cancelamento()
    {
        require_once VIEWS_PATH . '/site/cancelamento-wp.php';
    }

    public function termos()
    {
        require_once VIEWS_PATH . '/site/termos-wp.php';
    }

    public function termosAfiliados()
    {
        require_once VIEWS_PATH . '/site/termos-afiliados-wp.php';
    }

    public function cancelamentos()
    {
        require_once VIEWS_PATH . '/site/cancelamentos-wp.php';
    }
}
