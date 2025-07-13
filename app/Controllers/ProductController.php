<?php


namespace App\Controllers;


use App\Validation\ExampleValidation;
use Core\Log;
use Core\Request\Request;

class ProductController
{
    public function getProduct(ExampleValidation $validation, $id){
        return $validation->validated();
    }

    public function store(Request $request){
        return $request->all();
    }
}