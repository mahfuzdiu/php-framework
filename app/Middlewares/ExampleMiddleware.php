<?php
namespace App\Middlewares;

use Core\Middleware\IMiddleware;
use Core\Middleware\Middleware;

class ExampleMiddleware extends Middleware implements IMiddleware
{
    public function handle(\Core\Request\RequestHandler $requestHandler): bool
    {
        // TODO: Implement handle() method.
        return true;
    }
}