<?php
namespace App\Middlewares;

use Core\Middleware\IMiddleware;
use Core\Request\Request;

class ExampleMiddleware implements IMiddleware
{
    public function next(Request $request): bool
    {
        // TODO: Implement handle() method.
        return true;
    }
}