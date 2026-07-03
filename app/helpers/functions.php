<?php
/**
 * Funções auxiliares globais
 */

/**
 * Retorna URL base do site
 */
function base_url($path = '')
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    return $protocol . '://' . $host . '/' . ltrim($path, '/');
}

/**
 * Retorna URL de asset (CSS, JS, imagens)
 */
function asset($path)
{
    return base_url('public/' . ltrim($path, '/'));
}

/**
 * Retorna configuração do site
 */
function site_config($key, $default = '')
{
    return $GLOBALS['site_config'][$key] ?? $default;
}

/**
 * Escape HTML para prevenir XSS
 */
function e($string)
{
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Formata valor em dólar
 */
function format_money($value)
{
    return '$' . number_format((float)$value, 2, '.', ',');
}

/**
 * Formata data para exibição
 */
function format_date($date, $format = 'd/m/Y')
{
    return date($format, strtotime($date));
}

/**
 * Gera token CSRF
 */
function csrf_token()
{
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Campo hidden com CSRF
 */
function csrf_field()
{
    return '<input type="hidden" name="csrf_token" value="' . csrf_token() . '">';
}

/**
 * Verifica token CSRF
 */
function verify_csrf($token)
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Mensagem flash
 */
function flash($key, $message = null)
{
    if ($message !== null) {
        $_SESSION['flash'][$key] = $message;
    } else {
        $msg = $_SESSION['flash'][$key] ?? null;
        unset($_SESSION['flash'][$key]);
        return $msg;
    }
}

/**
 * Verifica se tem mensagem flash
 */
function has_flash($key)
{
    return isset($_SESSION['flash'][$key]);
}

/**
 * Gera slug a partir de texto
 */
function slugify($text)
{
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return $text;
}

/**
 * Trunca texto
 */
function str_limit($text, $limit = 100, $end = '...')
{
    if (mb_strlen($text) <= $limit) {
        return $text;
    }
    return mb_substr($text, 0, $limit) . $end;
}

/**
 * Verifica se é a página atual (para nav ativa)
 */
function is_current_page($page)
{
    $url = $_GET['url'] ?? '';
    return $url === $page || strpos($url, $page) === 0;
}
