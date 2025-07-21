<?php

namespace App\Controllers;

use App\Services\TestService;
use App\Validations\ExampleValidation;
use Core\Request\Request;
use Doctrine\ORM\EntityManagerInterface;

class ProductController
{
    public function __construct(TestService $testService, private EntityManagerInterface $entityManager){}

    public function getProduct(ExampleValidation $validation, $id)
    {
        return $validation->validated();
    }

    public function store(Request $request)
    {
        return $request->all();
    }
}