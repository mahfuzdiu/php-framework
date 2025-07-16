<?php

namespace Core\Validation\CustomRules;

use Core\Validation\ICustomRules;
use Respect\Validation\Validator as Validator;

class Min implements ICustomRules
{
    public function __construct(private $key, private $comparedTo){}

    public function validate($inputValue): void
    {
        $rule = Validator::intVal()->min($this->comparedTo)->setName($this->key);
        $rule->assert($inputValue);
    }
}