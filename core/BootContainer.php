<?php

namespace Core;

use Core\Exception\GlobalException;
use Core\ServiceProvider\ServiceProviderRegister;
use DI\Container;
use DI\ContainerBuilder;

final class BootContainer
{
    /**
     * initiate services ->
     * @return Application
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public static function boot(): Application
    {
        //to catch early exception before app load with all dependency resolved
        $minimalContainerBuilder = new ContainerBuilder();
        $minimalContainerBuilder->addDefinitions([
                Response::class => \DI\create(Response::class),
                GlobalException::class => \DI\autowire(GlobalException::class)
            ]
        );

        $minimalContainer = $minimalContainerBuilder->build();
        $minimalContainer->get(GlobalException::class)->registerErrorHandler();

        //boot the app including providers
        $container = (new ServiceProviderRegister())->registerServiceToContainer();
        return $container->get(Application::class);
    }
}