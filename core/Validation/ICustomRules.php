<?php

namespace Core\Validation;

interface ICustomRules
{
    public function validate($inputValue): void;
}
