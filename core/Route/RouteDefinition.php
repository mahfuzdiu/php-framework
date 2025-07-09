<?php
namespace Core\Route;


class RouteDefinition
{
    public function __construct(
        private $routeMethod,
        private $path,
        private $controller,
        private $controllerMethod,
        private $middlewares = []
    ){}

    public function toArray(): array
    {
        return [
            "http_method" => $this->routeMethod,
            "path" => trim($this->path, "/"),
            "controller" => $this->controller,
            "controller_method" => $this->controllerMethod,
            "middlewares" => $this->middlewares
        ];
    }
}