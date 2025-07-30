<?php

use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Middlewares\ExampleMiddleware;
use App\Middlewares\RouteMiddleware;

$this->router->group([ExampleMiddleware::class], function () {
    $this->router->post("/", [HomeController::class, "home"]);
    $this->router->post("/users/add", [UserController::class, "addUser"]);
    $this->router->get("/users/all", [UserController::class, "getUsers"]);
    $this->router->get("/users/{id}", [UserController::class, "getUser"])->middleware(RouteMiddleware::class);
});
