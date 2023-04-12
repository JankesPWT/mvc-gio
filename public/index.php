<?php

declare(strict_types = 1);

use App\App;
use App\Config;
use App\Container;
use App\Router;
use App\Controllers\HomeController;
use App\Controllers\AboutController;
use App\Controllers\FileController;
use App\Controllers\InvoiceController;
use App\Controllers\GeneratorExampleController;
use App\Controllers\UserController;


require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEW_PATH', __DIR__ . '/../views');

$container = new Container();
$router    = new Router($container);

$router->registerRoutesFromControllerAttributes(
    [
        HomeController::class,
        GeneratorExampleController::class,
        InvoiceController::class,
        UserController::class,
    ]
);

$router->get('/', [HomeController::class, 'index']);

$router->get('/upload', [FileController::class, 'index']);
$router->post('/upload', [FileController::class, 'upload']);
$router->get('/download', [FileController::class, 'download']);

$router->get('/about', [AboutController::class, 'index']);
$router->get('/about/create', [AboutController::class, 'create']);
$router->post('/about/create', [AboutController::class, 'store']);

$router->get(route: '/contact', action: function () { echo 'Contact'; });

$router->get('/examples/generator', [GeneratorExampleController::class, 'index']);

(new App(
        $container,
        $router,
        ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
        new Config($_ENV)
    ))->run();