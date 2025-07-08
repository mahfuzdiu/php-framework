<?php

use App\Controllers\HomeController;
use App\Controllers\ProductController;

$this->router->get("php-framework/", [HomeController::class, "home"]);
$this->router->get("php-framework/product/{id}", [ProductController::class, "getProduct"]);
$this->router->post("php-framework/products/add", [ProductController::class, "store"]);