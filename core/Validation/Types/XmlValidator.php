<?php

namespace Core\Validation\Types;

use Core\Validation\ICustomRules;

class XmlValidator implements ICustomRules
{
    public function validationLogic(): bool
    {
        return true;
    }
}
