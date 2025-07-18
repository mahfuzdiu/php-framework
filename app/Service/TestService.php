<?php

namespace App\Service;

class TestService
{
    private $name;

    public function __construct(string $name){
        $this->name = $name;
    }
}