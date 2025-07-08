<?php

namespace Core\Request;

class Request
{
    private $uri;
    private $httpMethod;
    private $inputs = [];
    private $queryParams = [];

    public function __construct()
    {
        $this->uri = $_SERVER["REQUEST_URI"];
        $this->httpMethod = $_SERVER["REQUEST_METHOD"];
        $this->setDefaultHeaders();
    }

    private function setDefaultHeaders(): void
    {
        header('Content-Type: application/json');
    }

    private function getRequestMethod(): string
    {
        return strtolower($this->httpMethod);
    }

    private function getUri(): string
    {
        return $this->uri;
    }

    private function setInputs($params): void
    {
        $this->inputs = $params;
    }

    private function setQueryParams($queryParams): void
    {
        $this->queryParams = $queryParams;
    }


    //these apis are available to public scope
    public function getInputs(): array
    {
        return $this->inputs;
    }

    public function getQueryPrams(): array
    {
        return $this->queryParams;
    }

    public function all(): array
    {
        return array_merge($this->inputs, $this->queryParams);
    }

    public function input($key): mixed
    {
        $allParams = $this->all();
        return isset($allParams[$key])? $allParams[$key] : null;
    }
}