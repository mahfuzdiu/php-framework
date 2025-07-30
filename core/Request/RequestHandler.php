<?php

namespace Core\Request;

class RequestHandler
{
    public function __construct(private Request $request)
    {
    }

    public function getInputs(): array
    {
        return $this->request->getInputs();
    }

    public function getAll(): array
    {
        return $this->request->all();
    }

    //todo: handle other http requests
    public function setInputDataInRequestClass($matchedRoute): void
    {
        if ($this->getHttpRequestMethod() == "get") {
            $this->closure(function ($matchedRoute) { $this->setInputs($matchedRoute["params"]); }, $matchedRoute);

        } elseif ($this->getHttpRequestMethod() == "post") {
            $inputs = json_decode(file_get_contents("php://input"), true);
            $this->closure(function ($inputs) { $this->setInputs($inputs); }, $inputs);
        }

        $this->closure(function ($matchedRoute) { $this->setQueryParams($matchedRoute["query_params"]); }, $matchedRoute);
    }

    public function getRequestUri(): string
    {
        return $this->closure(function () {
            return $this->getUri();
        });
    }

    public function getHttpRequestMethod(): string
    {
        return $this->closure(function () {
            return $this->getRequestMethod();
        });
    }

    private function closure(\Closure $closure, $argument = null): mixed
    {
        return $closure->bindTo($this->request, Request::class)($argument);
    }
}
