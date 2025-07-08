<?php
namespace Core;

use DI\Container;

class Router
{
    private array $allowedHttpMethods = ["get", "post", "put", "patch", "delete"];
    private $routes;

    public function __call(string $routerMethod, array $arguments)
    {
        if(!in_array($routerMethod, $this->allowedHttpMethods)){
            throw new \Exception($routerMethod . " is not allowed in route");
        }

        $this->routes[] = [
            "http_method" => $routerMethod,
            "path" => $arguments[0],
            "controller" => $arguments[1][0],
            "controller_method" => $arguments[1][1],
        ];
    }

    public function getMatchedRoute(string $uri): ?array
    {
        foreach ($this->routes as $route){
            $url = parse_url($uri, PHP_URL_PATH);
            $query = parse_url($uri, PHP_URL_QUERY);

            $urlParts = explode("/", trim($url, "/"));
            parse_str($query, $queryParams);

            $routeParts = explode("/", trim($route["path"], "/"));


            //basic match
            //todo: update to strong route matching validation. 1.same count but two different route
            if(count($routeParts) == count($urlParts)){
                $params = [];
                foreach ($routeParts as $key => $param){
                    if(preg_match("/^{([a-zA-Z]+)}$/", $param, $matches)){
                        $params[$matches[1]] = $urlParts[$key];
                    }
                }

                $route["params"] = $params;
                $route["query_params"] = $queryParams;
                return $route;
            }
        }

        return null;
    }


}