<?php

namespace Core\Validation;

use Core\Request\Request;
use Respect\Validation\Validator as Validator;
use Respect\Validation\Exceptions\ValidationException;

abstract class RequestValidation
{
    protected array $validatedData = [];
    protected array $errors        = [];

    abstract protected function rules();
    abstract protected function validated();

    public function __construct(private Request $request)
    {
        $this->validateInputs();
    }

    /*
     *todo: (improvement) use interface based validation logic for different types
     * of validation like JsonValidation, XmlValidation
     * */
    private function validateInputs(): void
    {
        $rules        = $this->rules();
        $inputs       = $this->request->all();
        $keysOfInputs = array_keys($inputs);

        foreach ($rules as $key => $ruleChain) {
            if (in_array($key, $keysOfInputs)) {
                $subRules = explode("|", $ruleChain);
                foreach ($subRules as $subRule) {
                    if (str_contains($subRule, ":")) {
                        [$rule, $comparedTo] = explode(":", $subRule);
                        //custom rule validation like:- min:10
                        //todo: add service provider to resolve factory class
                        $rulesFactory       = new CustomRulesFactory();
                        $customRuleInstance = $rulesFactory->make($key, $rule, [$comparedTo]);

                        try {
                            $customRuleInstance->validate($inputs[$key]);
                            //grab validated data if no error thrown
                            $this->validatedData[$key] = $inputs[$key];
                        } catch (ValidationException $exception) {
                            $this->errors[$key][] = $exception->getMessages()[$key];
                        }

                    } else {
                        try {
                            $validation = Validator::{$subRule}()->setName($key);
                            $validation->assert($inputs[$key]);
                            //grab validated data if no error thrown
                            $this->validatedData[$key] = $inputs[$key];
                        } catch (ValidationException $exception) {
                            $this->errors[$key][] = $exception->getMessages()[$key];
                        }
                    }
                }
            }
        }

        if (count($this->errors) > 0) {
            throw new \Exception(json_encode($this->errors));
        }
    }
}
