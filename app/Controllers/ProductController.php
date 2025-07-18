<?php

namespace App\Controllers;

use App\Service\TestService;
use App\Validations\ExampleValidation;
use Core\Request\Request;

class ProductController
{
    public function __construct(TestService $testService){}

    public function getProduct(ExampleValidation $validation, $id)
    {
        return $validation->validated();
    }

    public function store(Request $request)
    {
        return $request->all();
    }
}