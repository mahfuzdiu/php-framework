<?php


namespace App\Middlewares;


use Core\Middleware\IMiddleware;
use Core\Request\RequestHandler;

class RouteMiddleware implements IMiddleware
{
    public function next(RequestHandler $requestHandler): bool
    {
        // TODO: Implement handle() method.
        return true;
    }
}