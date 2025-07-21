<?php

namespace Core\ServiceProvider\Providers;

use Core\Orm\Doctrine;
use Core\ServiceProvider\ContainerBuilderDefinition;
use Core\ServiceProvider\IServiceProviderRegister;
use Doctrine\ORM\EntityManager;

class EntityManagerServiceProvider implements IServiceProviderRegister
{
    public function register(): ContainerBuilderDefinition
    {
        return new ContainerBuilderDefinition(EntityManager::class, function (Doctrine $doctrine) {
            return $doctrine->getEntityManager();
        } );
    }
}