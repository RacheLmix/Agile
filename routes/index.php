<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
use App\Controllers\admin\BookingController;
use App\Controllers\admin\HomeController;
use App\Controllers\admin\CategoryController;
use App\Controllers\admin\HomestayController;
use App\Controllers\admin\RoomController;
use App\Controllers\admin\UserController;
use App\Controllers\client\HomeController as ClientHomeController;
use App\Controllers\admin\AuthController;
$router = new \Bramus\Router\Router();

$router->get('/login', AuthController::class . '@showLoginForm');
$router->post('/loginsession', AuthController::class . '@handleLogin');
$router->get('/logout', AuthController::class . '@logout');
$router->before('GET|POST', '/admin/.*', function () {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
        header('Location: /login');
        exit();
    }
});

$router->mount('', function () use ($router) {

        $router->get('/', ClientHomeController::class . '@index');
    //viết tiếp Router ở dưới!!
    $router->mount('/admin', function () use ($router) {
        $router->get('/', HomeController::class . '@index');
        $router->get('/homestays', HomestayController::class . '@index');
        $router->get('/homestays/create', HomestayController::class . '@create');
        $router->post('/homestays/store', HomestayController::class . '@store');
        $router->get('/homestays/edit/{id}', HomestayController::class . '@edit');
        $router->post('/homestays/update/{id}', HomestayController::class . '@update');
        $router->get('/homestays/detail/{id}', HomestayController::class . '@detail');
        $router->get('/homestays/delete/{id}', HomestayController::class . '@delete');

        $router->get('/users', UserController::class . '@index');
        $router->get('/users/edit/{id}', UserController::class . '@edit');
        $router->get('/users/update/{id}', UserController::class . '@update');
        $router->get('/users/detail/{id}', UserController::class . '@detail');

        $router->get('/categories', CategoryController::class . '@index');
        $router->get('/categories/create', CategoryController::class . '@create');
        $router->get('/categories/store', CategoryController::class . '@store');
        $router->get('/categories/edit/{id}', CategoryController::class . '@edit');
        $router->get('/categories/update/{id}', CategoryController::class . '@update');
        $router->get('/categories/detail/{id}', CategoryController::class . '@detail');
        $router->get('/categories/delete/{id}', CategoryController::class . '@delete');

        $router->get('/rooms', RoomController::class . '@index'); // Fixed: was using CategoryController
        $router->get('/rooms/create', RoomController::class . '@create');
        $router->post('/rooms/store', RoomController::class . '@store');
        $router->get('/rooms/edit/{id}', RoomController::class . '@edit');
        $router->get('/rooms/update/{id}', RoomController::class . '@update');
        $router->get('/rooms/detail/{id}', RoomController::class . '@show');

        $router->get('/bookings', BookingController::class . '@index');
        $router->get('/bookings/details/{id}', BookingController::class . '@details');
        $router->get('/bookings/edit/{id}', BookingController::class . '@edit');
        $router->post('/bookings/update/{id}', BookingController::class . '@update');
    });

    $router->mount('/users', function () use ($router){
        // User specific routes can be added here
    });

});

// Add these routes to your existing routes

// Homestay detail page
$router->get('/homestay/{id}', 'App\Controllers\client\HomestayController@show');

// Booking processing route
$router->post('/homestay/{id}/book', 'App\Controllers\client\HomestayController@book');

// Homestay listing page (if needed)
$router->get('/homestays', 'App\Controllers\client\HomestayController@index');

// Run it!
$router->run();