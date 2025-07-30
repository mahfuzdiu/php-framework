<?php

namespace Core\Middleware;

use Core\Request\Request;
use Psr\Container\ContainerInterface;

class Middleware
{
    public function __construct(private ContainerInterface $container, private Request $request)
    {
    }

    public function checkMiddlewareValidation($middlewares)
    {
        foreach ($middlewares as $middleware) {
            $class = $this->container->get($middleware);
            if (!$class->next($this->request)) {
                throw new \Exception("Caught in Middleware : " . $middleware);
            }
        }
    }
}
