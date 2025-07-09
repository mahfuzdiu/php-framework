<?php
namespace App\Middlewares;

use Core\Middleware\IMiddleware;
use Core\Request\Request;
use Core\Request\RequestHandler;

class RouteMiddleware implements IMiddleware
{
    public function next(Request $request): bool
    {
        // TODO: Implement handle() method.
        return true;
    }
}