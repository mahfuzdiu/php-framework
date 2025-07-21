<?php

namespace Core\ServiceProvider;

class ContainerBuilderDefinition
{
    private string $class;
    private object $instance;

    public function __construct(string $class, object $instance)
    {
        $this->class = $class;
        $this->instance = $instance;
    }

    /**
     * @return \Closure[]
     */
    public function getDefinition(): array
    {
        if ($this->instance instanceof \Closure){
            return [
                $this->class => $this->instance
            ];
        }

        return [
            $this->class => function () {
                return $this->instance;
            }
        ];
    }
}