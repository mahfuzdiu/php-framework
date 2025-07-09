<?php


namespace Core\Middleware;


use Core\Request\RequestHandler;

interface IMiddleware
{
    public function next(RequestHandler $requestHandler): bool;
}