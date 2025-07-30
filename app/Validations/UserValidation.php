<?php

namespace App\Validations;

use Core\Request\Request;
use Core\Validation\RequestValidation;

class UserValidation extends RequestValidation
{
    public function __construct(private Request $request)
    {
        parent::__construct($this->request);
    }

    protected function rules(): array
    {
        return [
            "name"  => "alpha",
            "email" => "email"
        ];
    }

    public function validated(): array
    {
        return $this->validatedData;
    }
}
