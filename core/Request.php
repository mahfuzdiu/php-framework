<?php

namespace Core;

class Request
{
    private array $inputs;

    private function __construct($params, $query)
    {
        $this->inputs = array_merge($params, $query);
    }

    public static function setRequestData($params, $query): Request
    {
        return new self($params, $query);
    }

    public function input($key): ?string
    {
        return isset($this->inputs[$key]) ? $this->inputs[$key] : null;
    }

    public function all(): array
    {
        return $this->inputs;
    }
}