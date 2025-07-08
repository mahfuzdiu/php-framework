<?php
namespace Core;

use DI\Container;

class Router
{
    private array $allowedHttpMethods = ["get", "post", "put", "delete"];
    private string $uri;
    private array $params;

    public function __construct(private Container $container)
    {
        $this->uri = $_SERVER["REQUEST_URI"];
    }

    public function __call(string $routerMethod, array $arguments)
    {
        if(!in_array($routerMethod, $this->allowedHttpMethods)){
            throw new \Exception($routerMethod . " is not allowed in route");
        }

        $route = $arguments[0];
        $controller = $arguments[1][0];
        $controllerMethod = $arguments[1][1];

        $reflection  = new \ReflectionClass($controller);
        if(!$reflection->isInstantiable() || !$reflection->hasMethod($controllerMethod)){
            throw new \Exception("Controller or method is not available");
        }

        $reflectionMethod = $reflection->getMethod($controllerMethod);
        $reflectionMethodParameters = $reflectionMethod->getParameters();
        $matchedRequest = $this->getMatchedRequest($route);

        if(!is_null($matchedRequest)){
            $result = call_user_func_array([$reflection->newInstance(), $controllerMethod], $this->resolveMethodArguments($reflectionMethodParameters, $matchedRequest));
            echo json_encode($result);
        }
    }

    private function resolveMethodArguments($parameters, $request): array
    {
        $orderedParams = [];
        $normalParamIndexMatcher = 0;

        foreach ($parameters as $parameter){
            $type = $parameter->getType();

            if (
                $type instanceof \ReflectionNamedType &&
                !$type->isBuiltin() &&
                (class_exists($type->getName()) || interface_exists($type->getName()))
            ){
                if($type->getName() === Request::class){
                    $orderedParams[] = $request;
                } else
                    $orderedParams[] = $this->container->get($type->getName());
            } else {
                $orderedParams[] = $this->getParam($normalParamIndexMatcher);
                $normalParamIndexMatcher++;
            }
        }

        return $orderedParams;
    }


    private function getMatchedRequest($route): ?Request
    {
        $url = parse_url($this->uri, PHP_URL_PATH);
        $query = parse_url($this->uri, PHP_URL_QUERY);

        $routeParts = explode("/", trim($route, "/"));
        $urlParts = explode("/", trim($url, "/"));
        parse_str($query, $queryParts);

        if(count($routeParts) == count($urlParts)){
            $params = [];
            foreach ($routeParts as $key => $param){
                if(preg_match("/^{([a-zA-Z]+)}$/", $param, $matches)){
                    $params[] = $urlParts[$key];
                }
            }

            $this->setParam($params);
            return Request::setRequestData($params, $queryParts);
        }

        return null;
    }

    private function getParam($index): string
    {
        return $this->params[$index];
    }

    private function setParam($params): void
    {
        $this->params = $params;
    }
}