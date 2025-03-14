<?php
use App\Controllers\admin\BookingController;
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
    $router->mount('/admin', function () use ($router) {
        $router->get('/booking', BookingController::class . '@index');
    });

    $router->mount('/users', function () use ($router){});
});

// Run it!
$router->run();
