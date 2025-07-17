<?php

namespace Core\Exception;

use Core\Exception\HttpExceptions\RouteNotFoundException;
use Throwable;

class ErrorMessageHandler
{
    public function getErrorMessage(Throwable $throwable): string
    {
        return match (get_class($throwable)){
            RouteNotFoundException::class => "Route Not Found",
            default => $throwable->getMessage()
        };
    }
}