<?php
/**
 * Punta Cana para Brasileiros
 * Front Controller - Todas as requisições passam por aqui
 */

// Iniciar sessão
session_start();

// Definir constantes do sistema
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('PUBLIC_PATH', __DIR__);
define('VIEWS_PATH', APP_PATH . '/views');
define('UPLOADS_PATH', PUBLIC_PATH . '/uploads');

// Autoload simples
spl_autoload_register(function ($class) {
    $paths = [
        APP_PATH . '/core/',
        APP_PATH . '/models/',
        APP_PATH . '/controllers/',
        APP_PATH . '/helpers/',
    ];
    
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Carregar helpers
require_once APP_PATH . '/helpers/functions.php';

// Inicializar o banco de dados
$database = new Database();
$db = $database->getConnection();

// Carregar configurações do banco de dados
$configModel = new ConfigModel($db);
$GLOBALS['site_config'] = $configModel->getAll();

// Roteamento
$router = new Router();
$router->dispatch();
