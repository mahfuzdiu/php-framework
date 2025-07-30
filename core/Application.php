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
    ) {
    }

    public function load(): void
    {
        $this->loadRoutes();
        $matchedRoute = $this->router->getMatchedRoute($this->requestHandler, $this->requestHandler->getRequestUri());
        $result       = $this->dispatcher->dispatch($matchedRoute);
        $this->response->jsonResponse($result);
    }

    /**
     * loads routes
     */
    private function loadRoutes(): void
    {
        require_once __DIR__ . "/../route/routes.php";
    }
}
