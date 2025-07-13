<?php

namespace Core\Validation;

use Core\Request\RequestHandler;

abstract class RequestValidation
{
    protected array $validatedData;
    abstract protected function rules();

    public function __construct(private RequestHandler $requestHandler)
    {
        $this->validateInputs();
    }

    /*
     *todo: (improvement) use interface based validation logic for different types
     * of validation like JsonValidation, XmlValidation
     * */
    private function validateInputs(): void
    {
        $rules = $this->rules();
        $inputs = $this->requestHandler->getAll();

        //todo: match $inputs with $rules and return values
        $data = [3];
        $this->validatedData = $data;
    }
}