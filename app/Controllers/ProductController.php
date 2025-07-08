<?php


namespace App\Controllers;


use Core\Log;
use Core\Request\Request;

class ProductController
{
    public function getProduct(Request $request, $id){
        return $request->all();
    }

    public function store(Request $request){
        return $request->all();
    }
}