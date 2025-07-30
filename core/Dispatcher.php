<?php

namespace Core;

use Core\Middleware\Middleware;
use Psr\Container\ContainerInterface;

class Dispatcher
{
    //ContainerInterface $container: automatically give a Container instance
    public function __construct(private ContainerInterface $container, private Middleware $middleware)
    {
    }

    public function dispatch($matchedRoute): mixed
    {
        //todo: seperate route matching validation class
        if (is_null($matchedRoute)) {
            throw new \Exception("Route not found");
        }

        //middleware validation
        $this->middleware->checkMiddlewareValidation($matchedRoute["middlewares"]);


        //todo: seperate controller and method validation class

        $reflection = new \ReflectionClass($matchedRoute["controller"]);
        if (!$reflection->isInstantiable() || !$reflection->hasMethod($matchedRoute["controller_method"])) {
            throw new \Exception("Controller or method is not defined");
        }

        $reflectionMethod          = $reflection->getMethod($matchedRoute["controller_method"]);
        $reflectionMethodArguments = $reflectionMethod->getParameters();
        return call_user_func_array([$this->container->get($matchedRoute["controller"]), $matchedRoute["controller_method"]], $this->resolveMethodArguments($reflectionMethodArguments, $matchedRoute["params"]));
    }

    private function resolveMethodArguments($methodArguments, $routeParams): array
    {
        $orderedParams = [];
        foreach ($methodArguments as $argument) {
            $type = $argument->getType();

            if (
                $type instanceof \ReflectionNamedType && !$type->isBuiltin() && (class_exists($type->getName()) || interface_exists($type->getName()))
            ) {
                $orderedParams[] = $this->container->get($type->getName());
            } else {
                $orderedParams[] = $routeParams[$argument->getName()];
            }
        }

        return $orderedParams;
    }
}
