<?php
use App\Controllers\admin\BookingController;
use App\Controllers\admin\HomeController;
use App\Controllers\admin\CategoryController;
use App\Controllers\admin\HomestayController;
use App\Controllers\admin\RoomController;
use App\Controllers\admin\UserController;
// Create Router instance
$router = new \Bramus\Router\Router();

// viết router ở đây
$router->mount('', function () use ($router) {

    $router->get('/', function () {
        view('layout.layout');
    });
    //viết tiếp Router ở dưới!!
    $router->mount('/admin', function () use ($router) {
        $router->get('/', HomeController::class . '@index');
        $router->get('/homestay', HomestayController::class . '@index');
        $router->get('/homestay/create', HomestayController::class . '@create');
        $router->get('/homestay/store', HomestayController::class . '@store');
        $router->get('/homestay/edit/{id}', HomestayController::class . '@edit');
        $router->get('/homestay/update/{id}', HomestayController::class . '@update');
        $router->get('/homestay/detail/{id}', HomestayController::class . '@detail');
        $router->get('/homestay/delete/{id}', HomestayController::class . '@delete');

        $router->get('/user', UserController::class . '@index');
        $router->get('/user/edit/{id}', UserController::class . '@edit');
        $router->get('/user/update/{id}', UserController::class . '@update');
        $router->get('/user/detail/{id}', UserController::class . '@detail');

        $router->get('/category', CategoryController::class . '@index');
        $router->get('/category/create', CategoryController::class . '@create');
        $router->get('/category/store', CategoryController::class . '@store');
        $router->get('/category/edit/{id}', CategoryController::class . '@edit');
        $router->get('/category/update/{id}', CategoryController::class . '@update');
        $router->get('/category/detail/{id}', CategoryController::class . '@detail');
        $router->get('/category/delete/{id}', CategoryController::class . '@delete');

        $router->get('/room', CategoryController::class . '@index');
        $router->get('/room/create', CategoryController::class . '@create');
        $router->get('/room/store', CategoryController::class . '@store');
        $router->get('/room/edit/{id}', CategoryController::class . '@edit');
        $router->get('/room/update/{id}', CategoryController::class . '@update');
        $router->get('/room/detail/{id}', CategoryController::class . '@detail');
        $router->get('/room/delete/{id}', CategoryController::class . '@delete');

        $router->get('/booking', BookingController::class . '@index');
    });

    $router->mount('/users', function () use ($router){});
});

// Run it!
$router->run();
