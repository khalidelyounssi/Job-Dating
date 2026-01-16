<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\AuthController;
use App\Core\Session;

Session::start();

$router = new Router();


$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'register']);

$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);

$router->get('/logout', [AuthController::class, 'logout']);

$router->get('/', function() {
    echo "<h1>Bienvenue sur Job Dating</h1>"; 
});

$router->dispatch();