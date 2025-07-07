<?php

namespace App\Controllers;

use Core\Log;
use Core\Request;

class HomeController
{
    public function getHome(Request $request, $category, $id){
        return $id;
    }
}