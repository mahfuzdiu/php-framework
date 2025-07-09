<?php

use App\Controllers\HomeController;
use App\Controllers\ProductController;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\ExampleMiddleware;
use App\Middlewares\RouteMiddleware;

$this->router->get("php-framework/", [HomeController::class, "home"]);

$this->router->group([ExampleMiddleware::class, AuthMiddleware::class], function (){
    $this->router->get("php-framework/product/{id}", [ProductController::class, "getProduct"])->middleware(RouteMiddleware::class);
    $this->router->post("php-framework/products/add", [ProductController::class, "store"]);
});