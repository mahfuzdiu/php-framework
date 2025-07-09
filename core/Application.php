<?php
namespace Core;

use Core\Request\RequestHandler;
use Core\Route\Router;

class Application
{
    public function __construct(
        private RequestHandler $requestHandler,
        private Router $router,
        private Dispatcher $dispatcher,
        private Response $response
    ){}

    public function boot(): void
    {
        $this->loadRoutes();
        $matchedRoute = $this->router->getMatchedRoute($this->requestHandler, $this->requestHandler->getRequestUri());

        //middleware

        $result = $this->dispatcher->dispatch($matchedRoute);
        $this->response->jsonResponse($result);
    }

    private function loadRoutes(){
        require_once __DIR__ . "/../routes.php";
    }
}