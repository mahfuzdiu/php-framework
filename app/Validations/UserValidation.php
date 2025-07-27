<?php

namespace App\Validations;

use Core\Request\RequestHandler;
use Core\Validation\RequestValidation;

class UserValidation extends RequestValidation
{
    public function __construct(private RequestHandler $requestHandler){
        parent::__construct($this->requestHandler);
    }

    protected function rules(): array
    {
        return [
            "name" => "alpha",
            "email" => "email"
        ];
    }

    public function validated(): array
    {
        return $this->validatedData;
    }
}