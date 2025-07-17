<?php

namespace Core\Exception\HttpExceptions;

use Exception;

class RouteNotFoundException extends Exception
{
    protected $code = 404;
}