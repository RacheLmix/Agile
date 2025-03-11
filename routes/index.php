<?php
// Create Router instance
$router = new \Bramus\Router\Router();

// viết router ở đây
$router->mount('', function () use ($router) {

    $router->get('/', function () {
        echo "Hello World";
    });
    //viết tiếp Router ở dưới!!

});

// Run it!
$router->run();
