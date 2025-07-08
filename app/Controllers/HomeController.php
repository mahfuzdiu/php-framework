<?php

namespace App\Controllers;

use Core\Log;
use Core\Request;

class HomeController
{
    public function home(){
        return [
            "route" => "/",
            "method" => "home"
        ];
    }

    public function getPrice(){
        return 100;
    }
}