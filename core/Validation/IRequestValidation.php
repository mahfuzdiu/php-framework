<?php

namespace Core\Validation;

interface IRequestValidation
{
    public function validationLogic(): bool;
}