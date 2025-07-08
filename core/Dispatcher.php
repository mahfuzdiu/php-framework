<?php


namespace Core;


use Core\Request\RequestHandler;
use Psr\Container\ContainerInterface;

class Dispatcher
{
    //ContainerInterface $container: automatically give a Container instance
    public function __construct(private ContainerInterface $container){}

    public function dispatch($matchedRoute): mixed
    {
        if(is_null($matchedRoute)){
            throw new \Exception("Route not found");
        }

        $reflection  = new \ReflectionClass($matchedRoute["controller"]);
        if(!$reflection->isInstantiable() || !$reflection->hasMethod($matchedRoute["controller_method"])){
            throw new \Exception("Controller or method is not defined");
        }

        $reflectionMethod = $reflection->getMethod($matchedRoute["controller_method"]);
        $reflectionMethodArguments = $reflectionMethod->getParameters();
        return call_user_func_array([$reflection->newInstance(), $matchedRoute["controller_method"]], $this->resolveMethodArguments($reflectionMethodArguments, $matchedRoute["params"]));
    }

    private function resolveMethodArguments($methodArguments, $routeParams): array
    {
        $orderedParams = [];
        foreach ($methodArguments as $argument){
            $type = $argument->getType();

            if (
                $type instanceof \ReflectionNamedType &&
                !$type->isBuiltin() &&
                (class_exists($type->getName()) || interface_exists($type->getName()))
            ){
                $orderedParams[] = $this->container->get($type->getName());
            } else {
                $orderedParams[] = $routeParams[$argument->getName()];
            }
        }

        return $orderedParams;
    }

}