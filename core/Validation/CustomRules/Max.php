<?php

namespace Core\Validation\CustomRules;

use Core\Validation\ICustomRules;
use Respect\Validation\Validator as Validator;

class Max implements ICustomRules
{
    public function __construct(private $key, private $comparedTo)
    {
    }

    public function validate($inputValue): void
    {
        $rule = Validator::intVal()->max($this->comparedTo)->setName($this->key);
        $rule->assert($inputValue);
    }
}
