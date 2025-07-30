<?php

namespace Core;

use Core\Exception\GlobalException;
use Core\ServiceProvider\ServiceProviderRegister;
use DI\ContainerBuilder;
use Dotenv\Dotenv;

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
        $minimalContainerBuilder->addDefinitions(
            [
                GlobalException::class => \DI\autowire(GlobalException::class)
            ]
        );

        $minimalContainer = $minimalContainerBuilder->build();
        $minimalContainer->get(GlobalException::class)->registerErrorHandler();

        //loads env
        self::loadEnv();

        //boot the app including providers
        $container = (new ServiceProviderRegister())->registerServiceToContainer();
        return $container->get(Application::class);
    }


    /**
     * loads env
     */
    private static function loadEnv(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
    }
}
