<?php

namespace App\Controllers;

use Core\Log;
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