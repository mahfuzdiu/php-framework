<?php

namespace App\Services;

class TestService
{
    private $name;

    public function __construct(string $name){
        $this->name = $name;
    }
}