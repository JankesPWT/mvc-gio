<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEW_PATH', __DIR__ . '/../views');

use App\App;
use App\Config;
use App\Router;
use App\Controllers\AboutController;
use App\Controllers\HomeController;
use App\Controllers\FileController;


$router = new Router();

$router->get('/', [HomeController::class, 'index']);

$router->get('/upload', [FileController::class, 'index']);
$router->post('/upload', [FileController::class, 'upload']);
$router->get('/download', [FileController::class, 'download']);

$router->get('/about', [AboutController::class, 'index']);
$router->get('/about/create', [AboutController::class, 'create']);
$router->post('/about/create', [AboutController::class, 'store']);

$router->get(route: '/contact', action: function () { echo 'Contact'; });


(new App(
        router: $router,
        request: ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
        config: new Config($_ENV)
))->run();