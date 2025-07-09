<?php
namespace Core\Middleware;

use Core\Request\RequestHandler;
use Psr\Container\ContainerInterface;

class Middleware
{
    public function __construct(private ContainerInterface $container, private RequestHandler $requestHandler){}

    public function checkMiddlewareValidation($middlewares)
    {
        foreach ($middlewares as $middleware){
            $class = $this->container->get($middleware);
            if(!$class->next($this->requestHandler)){
                throw new \Exception("Caught in Middleware : " . $middleware);
            }
        }
    }
}