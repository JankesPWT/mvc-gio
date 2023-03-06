<?php
require_once __DIR__ . '/../vendor/autoload.php';

define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEW_PATH', __DIR__ . '/../views');

use App\View;
use App\Controllers\HomeController;
use App\Controllers\AboutController;
use App\Exceptions\RouteNotFoundException;

try {
    //włącz serwer 'php -S localhost' 
    $router = new App\Router();

    $router->get('/', [HomeController::class, 'index']);
    $router->post('/upload', [HomeController::class, 'upload']);
    
    $router->get('/download', [HomeController::class, 'download']);

    $router->get('/about', [AboutController::class, 'index']);
    $router->get('/about/create', [AboutController::class, 'create']);
    $router->post('/about/create', [AboutController::class, 'store']);

    $router->get(route: '/contact', action: function () { echo 'Contact'; });

    echo $router->resolve(
        $_SERVER['REQUEST_URI'], 
        strtolower($_SERVER['REQUEST_METHOD'])
    );
} catch (RouteNotFoundException $e) {
    //header('HTTP/1.1 404 Not Found');
    http_response_code(404);

    echo View::make('error/404');
}