<?php
namespace Core;

use DI\Container;

class Application
{
    private Router $router;

    public function __construct(private Container $container){
    }

    public function boot(): void
    {
        $this->router = $this->container->get(Router::class);
        $this->loadRoutes();
    }

    private function loadRoutes(){
        require_once __DIR__ . "/../routes.php";
    }
}