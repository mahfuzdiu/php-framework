<?php
namespace Core;

use DI\Container;

class Application
{
    private Container $container;
    private Router $router;

    public function __construct(Container $container){
        $this->container = $container;
    }

    public function boot(): void
    {
        $this->router = new Router($this->container);
        $this->loadRoutes();
    }

    private function loadRoutes(){
        require_once __DIR__ . "/../routes.php";
    }
}