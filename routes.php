<?php

use App\Controllers\HomeController;

$this->route->get("framework/home/image/{category}/{id}/books", [HomeController::class, "getHome"]);
//$this->route->post("framework/home/image/{category}/{id}", [HomeController::class, "postHome"]);