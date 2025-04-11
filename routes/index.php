<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use App\Controllers\admin\BookingController as AdminBookingController;
use App\Controllers\admin\HomeController;
use App\Controllers\admin\CategoryController;
use App\Controllers\admin\HomestayController;
use App\Controllers\admin\RoomController;
use App\Controllers\admin\UserController;
use App\Controllers\client\HomeController as ClientHomeController;
use App\Controllers\client\HomestayController as ClientHomestayController;
use App\Controllers\admin\AuthController;
use App\Controllers\admin\RatingController;
use App\Controllers\admin\AmenityController;
use App\Controllers\admin\PromotionController;
use App\Controllers\client\ProfileController;
use App\Controllers\client\BookingController;

$router = new \Bramus\Router\Router();

$router->get('/login', AuthController::class . '@showLoginForm');
$router->get('/signin', AuthController::class . '@showsignin');
$router->post('/sign', AuthController::class . '@signin');
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
    $router->get('/homestays', ClientHomestayController::class . '@index');
    $router->get('/homestays/detail/{id}', ClientHomestayController::class . '@detail');
    $router->post('/homestays/detail/{id}/book', ClientHomestayController::class . '@book');
    $router->get('/profile', ProfileController::class . '@index');
    $router->get('/profile/edit/{id}', ProfileController::class . '@edit');
    $router->post('/profile/update/{id}', ProfileController::class . '@update');
    $router->get('/booking/{homestay_id}', BookingController::class . '@show');
    $router->post('/booking/store', BookingController::class . '@store');
    $router->get('/booking/success/{booking_id}', BookingController::class . '@success');
    $router->get('/cart', BookingController::class . '@cart'); // Thêm tuyến đường mới cho giỏ hàng

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
        $router->post('/users/update/{id}', UserController::class . '@update');
        $router->get('/users/detail/{id}', UserController::class . '@detail');

        $router->get('/categories', CategoryController::class . '@index');
        $router->get('/categories/create', CategoryController::class . '@create');
        $router->post('/categories/store', CategoryController::class . '@store');
        $router->get('/categories/edit/{id}', CategoryController::class . '@edit');
        $router->post('/categories/update/{id}', CategoryController::class . '@update');
        $router->get('/categories/detail/{id}', CategoryController::class . '@detail');
        $router->get('/categories/delete/{id}', CategoryController::class . '@delete');

        $router->get('/rooms', RoomController::class . '@index');
        $router->get('/rooms/create', RoomController::class . '@create');
        $router->post('/rooms/store', RoomController::class . '@store');
        $router->get('/rooms/edit/{id}', RoomController::class . '@edit');
        $router->post('/rooms/update/{id}', RoomController::class . '@update');
        $router->get('/rooms/detail/{id}', RoomController::class . '@show');

        $router->get('/bookings', AdminBookingController::class . '@index');
        $router->get('/bookings/details/{id}', AdminBookingController::class . '@details');
        $router->get('/bookings/edit/{id}', AdminBookingController::class . '@edit');
        $router->post('/bookings/update/{id}', AdminBookingController::class . '@update');

        $router->get('/ratings', RatingController::class . '@index');
        $router->get('/ratings/edit/{id}', RatingController::class . '@edit');
        $router->post('/ratings/update/{id}', RatingController::class . '@update');
        $router->get('/ratings/detail/{id}', RatingController::class . '@detail');

        $router->get('/amenities', AmenityController::class . '@index');
        $router->get('/amenities/create', AmenityController::class . '@create');
        $router->post('/amenities/store', AmenityController::class . '@store');
        $router->get('/amenities/edit/{id}', AmenityController::class . '@edit');
        $router->post('/amenities/update/{id}', AmenityController::class . '@update');
        $router->get('/amenities/detail/{id}', AmenityController::class . '@detail');
        $router->get('/amenities/delete/{id}', AmenityController::class . '@delete');

        $router->get('/promotions', PromotionController::class . '@index');
        $router->get('/promotions/create', PromotionController::class . '@create');
        $router->post('/promotions/store', PromotionController::class . '@store');
        $router->get('/promotions/edit/{id}', PromotionController::class . '@edit');
        $router->post('/promotions/update/{id}', PromotionController::class . '@update');
        $router->get('/promotions/delete/{id}', PromotionController::class . '@delete');
    });

    //    $router->mount('/users', function () use ($router) {
//        // User specific routes can be added here
//    });
});

$router->run();