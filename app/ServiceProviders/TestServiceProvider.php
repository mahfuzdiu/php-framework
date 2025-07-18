<?php

namespace App\ServiceProviders;

use App\Service\TestService;
use Core\ServiceProvider\ContainerBuilderDefinition;
use Core\ServiceProvider\IServiceProviderRegister;
use DI\ContainerBuilder;

class TestServiceProvider implements IServiceProviderRegister
{
    public function register(): ContainerBuilderDefinition
    {
        return new ContainerBuilderDefinition(TestService::class, new TestService("test_name"));
    }
}