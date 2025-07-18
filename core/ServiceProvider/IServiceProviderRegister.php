<?php

namespace Core\ServiceProvider;

interface IServiceProviderRegister
{
    public function register(): ContainerBuilderDefinition;
}