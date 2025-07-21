<?php

namespace Core\ServiceProvider;

use App\ServiceProviders\TestServiceProvider;
use DI\Container;
use DI\ContainerBuilder;

class ServiceProviderRegister
{
    public function registerServiceToContainer(): Container
    {
        $containerBuilder = new ContainerBuilder();
        $providers = $this->getRegisteredServiceProviders();

        foreach ($providers as $providerClass) {
            $containerBuilderDefinition  = (new $providerClass())->register();
            $containerBuilder->addDefinitions($containerBuilderDefinition->getDefinition());
        }

        return $containerBuilder->build();
    }

    /**
     * return user + core service providers array
     * @return array
     */
    private function getRegisteredServiceProviders(): array
    {
        $userRegisteredServiceProviders = require_once __DIR__ . "/../../app/ServiceProviders/register.php";
        $coreServiceProviders = require_once __DIR__ . "/Providers/register.php";
        return array_merge_recursive($userRegisteredServiceProviders, $coreServiceProviders);
    }
}