<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\Klasa;

//włącz serwer 'php -S localhost' 
$router = new App\Router();

$router->get('/', [Home::class, 'index']);
$router->get(route: '/contact', action: function () { echo 'Contact'; });

$router->get('/klasa', [Klasa::class, 'index']);
$router->get('/klasa/create', [Klasa::class, 'create']);
$router->post('/klasa/create', [Klasa::class, 'store']);

echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));

echo '<pre>';
//print_r($router);
echo'</pre>';