<?php
namespace Core\Route;

use Core\Request\RequestHandler;
use DI\Container;

class Router
{
    private array $allowedHttpMethods = ["get", "post", "put", "patch", "delete"];
    private $routes;
    private array $middlewares = [];

    public function __call(string $routerMethod, array $arguments): Router
    {
        if(!in_array($routerMethod, $this->allowedHttpMethods)){
            throw new \Exception($routerMethod . " is not allowed in route");
        }

        $this->routes[] = (new RouteDefinition($routerMethod,  $arguments[0], $arguments[1][0], $arguments[1][1], $this->middlewares))->toArray();
        return $this;
    }

    public function getMatchedRoute(RequestHandler $requestHandler, string $uri): ?array
    {
        foreach ($this->routes as $route){
            $url = parse_url($uri, PHP_URL_PATH);
            $query = parse_url($uri, PHP_URL_QUERY);

            $urlParts = explode("/", trim($url, "/"));
            parse_str($query ?? "", $queryParams);
            $routeParts = explode("/", $route["path"]);

            if($this->checkRouteMatch($routeParts, $urlParts)){
                $params = [];
                foreach ($routeParts as $key => $param){
                    if(preg_match("/^{([a-zA-Z]+)}$/", $param, $matches)){
                        $params[$matches[1]] = $urlParts[$key];
                    }
                }

                $route["params"] = $params;
                $route["query_params"] = $queryParams;

                //set input data/params to Request::class before method execution
                $requestHandler->setInputDataInRequestClass($route);

                return $route;
            }
        }

        return null;
    }


    /**
     * check if route is a exact match
     * @param $routeParts
     * @param $urlParts
     * @return bool
     */
    private function checkRouteMatch($routeParts, $urlParts): bool
    {
        if(count($routeParts) != count($urlParts)){
            return false;
        }

        foreach ($routeParts as $key => $part){
            if(preg_match("/^{([a-zA-Z]+)}$/", $part, $matches)){
                continue;
            } else if($part != $urlParts[$key]){
                return false;
            }
        }

        return true;
    }

    public function group(array $middlewares, \Closure $closure){
        $this->middlewares = $middlewares;
        $closure();
    }

    public function middleware($routeMiddleware){
        $this->routes[count($this->routes) - 1]["middlewares"][] = $routeMiddleware;
    }
}