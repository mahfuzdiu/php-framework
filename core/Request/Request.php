<?php

namespace Core\Request;

class Request
{
    private $uri;
    private $uriParams;
    private $queryParams;

    public function __construct()
    {
        $this->uri = $_SERVER["REQUEST_URI"];
        $this->setInputParams();
        $this->setDefaultHeaders();
    }

    private function setDefaultHeaders(){
        header('Content-Type: application/json');
    }

    private function setUriParams($params): void
    {
        $this->uriParams = $params;
    }

    private function setQueryParams($queryParams): void
    {
        $this->queryParams = $queryParams;
    }

    private function getUri(){
        return $this->uri;
    }

    private function setInputParams(){

    }

    public function getUriParams(): array
    {
        return $this->uriParams;
    }

    public function getQueryPrams(): array
    {
        return $this->queryParams;
    }

    public function all(): array
    {
        return array_merge($this->uriParams, $this->queryParams);
    }

    public function input($key)
    {
        $allParams = $this->all();
        return isset($allParams[$key])? $allParams[$key] : null;
    }
}