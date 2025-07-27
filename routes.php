<?php

use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Middlewares\ExampleMiddleware;
use App\Middlewares\RouteMiddleware;

$this->router->group([ExampleMiddleware::class], function (){
    $this->router->post("php-framework/", [HomeController::class, "home"]);
    $this->router->post("php-framework/users/add", [UserController::class, "addUser"]);
    $this->router->get("php-framework/users/all", [UserController::class, "getUsers"]);
    $this->router->get("php-framework/users/{id}", [UserController::class, "getUser"])->middleware(RouteMiddleware::class);
});
