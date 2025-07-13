<?php
namespace App\Validation;

use Core\Request\RequestHandler;
use Core\Validation\RequestValidation;

class ExampleValidation extends RequestValidation
{
    public function __construct(private RequestHandler $requestHandler){
        parent::__construct($this->requestHandler);
    }

    protected function rules(): array
    {
        return [
            "id" => ["numeric"],
            "price" => ["decimal"],
            "category" => ["text", "uppercase"]
        ];
    }

    public function validated(): array
    {
        return $this->validatedData;
    }
}