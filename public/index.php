<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;

$router = new Router();


$router->get('/', function() {
    echo "<h1>Home Page</h1>";
});

$router->get('/login', function() {
    echo "<h1>Login Page</h1>";
});

$router->get('/user/{id}', function($id) {
    echo "<h1>User ID: $id</h1>";
});

$router->dispatch();