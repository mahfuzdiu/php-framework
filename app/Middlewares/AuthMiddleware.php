<?php
namespace App\Middlewares;

class AuthMiddleware extends \Core\Middleware\Middleware implements \Core\Middleware\IMiddleware
{
    public function handle(\Core\Request\RequestHandler $requestHandler): bool
    {
        // TODO: Implement handle() method.
        return true;
    }
}