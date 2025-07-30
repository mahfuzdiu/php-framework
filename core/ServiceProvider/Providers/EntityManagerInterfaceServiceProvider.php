<?php

namespace Core\ServiceProvider\Providers;

use Core\ServiceProvider\ContainerBuilderDefinition;
use Core\ServiceProvider\IServiceProviderRegister;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class EntityManagerInterfaceServiceProvider implements IServiceProviderRegister
{
    public function register(): ContainerBuilderDefinition
    {
        return new ContainerBuilderDefinition(EntityManagerInterface::class, function (EntityManager $entityManager) {
            return $entityManager;
        });
    }
}
