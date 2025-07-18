<?php

namespace App\Controllers;

use Core\Request;

class HomeController
{
    public function home(){
        return [
            "route" => "/",
            "message" => "welcome home",
        ];
    }
}