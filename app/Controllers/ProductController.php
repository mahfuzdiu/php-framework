<?php


namespace App\Controllers;


use Core\Request\Request;

class ProductController
{
    public function getProduct(Request $request, $id){
        return [
            "route" => "/product/${id}",
            "method" => "getProduct"
        ];
    }
}