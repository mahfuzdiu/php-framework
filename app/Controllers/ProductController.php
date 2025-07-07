<?php


namespace App\Controllers;


class ProductController
{
    public function getProduct($id){
        return [
            "route" => "/product/${id}",
            "method" => "getProduct"
        ];
    }
}