<?php
use App\Controllers\admin\BookingController;
// Create Router instance
$router = new \Bramus\Router\Router();

// viết router ở đây
$router->mount('', function () use ($router) {

    $router->get('/', function () {
        view('layout.layout');
    });
    //viết tiếp Router ở dưới!!
    $router->mount('/admin', function () use ($router) {
        $router->mount('/dashboard', function () use ($router) {
        $router->get('/booking', BookingController::class . '@index');
        });
    });

    $router->mount('/users', function () use ($router){});
});

// Run it!
$router->run();
