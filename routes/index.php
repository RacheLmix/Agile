<?php
// Create Router instance
$router = new \Bramus\Router\Router();

require_once "web.php";
require_once "admin.php";

// viết router ở đây
$router->mount('', function () use ($router) {

    $router->get('/', function () {
        view('layout.layout');
    });
    //viết tiếp Router ở dưới!!
    $router->mount('/users', function () use ($router){
        $router->get('/index', UserControllers::class . '@index');
    });
});

// Run it!
$router->run();
