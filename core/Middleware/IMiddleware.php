<?php
namespace Core\Middleware;

use Core\Request\Request;

interface IMiddleware
{
    public function next(Request $request): bool;
}