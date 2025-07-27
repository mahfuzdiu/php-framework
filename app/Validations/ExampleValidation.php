<?php
namespace App\Validations;

use Core\Request\Request;
use Core\Validation\RequestValidation;

class ExampleValidation extends RequestValidation
{
    public function __construct(private Request $request){
        parent::__construct($this->request);
    }

    protected function rules(): array
    {
        return [
            "id" => "max:10|numericVal",
            "sort" => "alpha"
        ];
    }

    public function validated(): array
    {
        return $this->validatedData;
    }
}