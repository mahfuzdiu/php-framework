<?php

namespace Core\ServiceProvider\Providers;

use Core\Orm\Doctrine;
use Core\ServiceProvider\ContainerBuilderDefinition;
use Core\ServiceProvider\IServiceProviderRegister;

class DoctrineServiceProvider implements IServiceProviderRegister
{
    public function register(): ContainerBuilderDefinition
    {
        return new ContainerBuilderDefinition(Doctrine::class, new Doctrine($this->getDbConfig(), $isDevMode = false));
    }

    /**
     * return db credentials
     * @return array
     */
    private function getDbConfig(): array
    {
        $allDbConfigs = require_once __DIR__ . "/../../../config/database.php";
        return $allDbConfigs["drivers"][$allDbConfigs["use"]];
    }
}