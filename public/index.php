<?php
require_once __DIR__ . '/../vendor/autoload.php';

define('STORAGE_PATH', __DIR__ . '/../storage');
use App\Controllers\Home;
use App\Controllers\Klasa;

//włącz serwer 'php -S localhost' 
$router = new App\Router();

$router->get('/', [Home::class, 'index']);
$router->post('/upload', [Home::class, 'upload']);

$router->get('/klasa', [Klasa::class, 'index']);
$router->get('/klasa/create', [Klasa::class, 'create']);
$router->post('/klasa/create', [Klasa::class, 'store']);

$router->get(route: '/contact', action: function () { echo 'Contact'; });

echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));

echo '<pre>';
//print_r($router);
echo'</pre>';