<?php

namespace Core\Exception;

use Throwable;

class DbConnectionFailure extends \Exception
{
    public function __construct($message = "", Throwable $previous = null)
    {
        parent::__construct($this->message, 0, $previous);
    }
}