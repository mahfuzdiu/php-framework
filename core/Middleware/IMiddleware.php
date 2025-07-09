<?php


namespace Core\Middleware;


use Core\Request\RequestHandler;

interface IMiddleware
{
    public function handle(RequestHandler $requestHandler): bool;
}