<?php
namespace Core\Validation\Types;

use Core\Validation\IRequestValidation;

class JsonValidator implements IRequestValidation
{
    public function validationLogic(): bool
    {
        return true;
    }
}