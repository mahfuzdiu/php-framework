<?php
namespace Core\Validation\Types;

use Core\Validation\IRequestValidation;

class XmlValidator implements IRequestValidation
{
    public function validationLogic(): bool
    {
        return true;
    }
}