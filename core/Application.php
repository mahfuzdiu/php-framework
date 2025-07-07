<?php
namespace Core;

class Application
{
    private Route $route;

    public function __construct(Route $route){
        $this->route = $route;
        $this->loadRoutes();
    }

    function boot(): void
    {

    }

    private function loadRoutes(){
        require_once __DIR__ . "/../routes.php";
    }
}