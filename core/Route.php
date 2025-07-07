<?php
namespace Core;

class Route extends Request
{
    private Response $response;
    private array $allowedHttpMethods = ["get", "post", "put", "delete"];
    private string $uri;
    private array $params;
    private array $queryParams;

    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->uri = $_SERVER["REQUEST_URI"];
    }

    public function __call(string $methodName, array $arguments)
    {
        if(!in_array($methodName, $this->allowedHttpMethods)){
            throw new \Exception($methodName . " is not allowed in route");
        }

        $route = $arguments[0];
        $controller = $arguments[1][0];
        $methodName = $arguments[1][1];

        $reflection  = new \ReflectionClass($controller);

        if(!$reflection->isInstantiable() || !$reflection->hasMethod($methodName)){
            throw new \Exception("Controller or method is not available");
        }

        $method = $reflection->getMethod($methodName);
        $parameters = $method->getParameters();
        $request = $this->processRouteParameters($methodName, $route);
        $result = call_user_func_array([$reflection->newInstance(), $methodName], $this->resolveMethodArguments($parameters, $request));
        echo $this->response->jsonResponse($result);
    }

    private function resolveMethodArguments($parameters, $request): array
    {
        $orderedParams = [];
        $normalParamIndexMatcher = 0;

        foreach ($parameters as $parameter){
            if ($parameter->getType() && $parameter->getType()->getName() === Request::class){
                $orderedParams[] = $request;
            } else {
                $orderedParams[] = $this->getParam($normalParamIndexMatcher);
                $normalParamIndexMatcher++;
            }
        }

        return $orderedParams;
    }


    private function processRouteParameters($methodName, $route): Request
    {
        $url = parse_url($this->uri, PHP_URL_PATH);
        $query = parse_url($this->uri, PHP_URL_QUERY);

        $routeParts = explode("/", trim($route, "/"));
        $urlParts = explode("/", trim($url, "/"));
        parse_str($query, $queryParts);

        if(count($routeParts) != count($urlParts)){
            throw new \Exception("Route not found", 404);
        }

        $params = [];
        foreach ($routeParts as $key => $param){
            if(preg_match("/^{([a-zA-Z]+)}$/", $param, $matches)){
                $params[] = $urlParts[$key];
            }
        }

        $this->setParam($params);
        return Request::setRequestData($params, $queryParts);
    }

    private function getParam($index): string
    {
        return $this->params[$index];
    }

    private function setParam($params): void
    {
        $this->params = $params;
    }

    private function setQueryParams($queryParts): void
    {
        $this->queryParams = $queryParts;
    }
}