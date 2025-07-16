<?php

namespace Core\Validation;

use Core\Validation\CustomRules\Max;
use Core\Validation\CustomRules\Min;

class CustomRulesFactory
{
    public function make($key, string $rule, array $params)
    {
        return match ($rule){
            "min" => new Min($key, $params[0]),
            "max" => new Max($key, $params[0])
        };
    }
}