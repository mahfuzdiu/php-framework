<?php

namespace Core\ServiceProvider;

use App\Service\TestService;
use App\ServiceProviders\TestServiceProvider;
use DI\Container;
use DI\ContainerBuilder;

class ServiceProviderRegister
{
    public function registerServiceToContainer(): Container
    {
        $containerBuilder = new ContainerBuilder();
        $providers = [
            TestServiceProvider::class
        ];

        foreach ($providers as $providerClass) {
            $containerBuilderDefinition  = (new $providerClass())->register();
            $containerBuilder->addDefinitions($containerBuilderDefinition->getDefinition());
        }

        return $containerBuilder->build();
    }
}