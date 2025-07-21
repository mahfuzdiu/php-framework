<?php

namespace Core\Orm;

use Core\Exception\DbConnectionFailure;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class Doctrine
{
    public  function __construct(private $databaseConfig, private $isDevMode = false){}

    public function getEntityManager(): EntityManager
    {
        $config = ORMSetup::createAttributeMetadataConfig(paths: [__DIR__ . '/../../app/Models'], isDevMode: $this->isDevMode,);
        $config->setProxyDir(__DIR__ . "/../../doctrine/proxies");
        $config->setProxyNamespace('Doctrine\\Proxies');
        $config->setAutoGenerateProxyClasses(true);

        $connection = DriverManager::getConnection($this->databaseConfig, $config);
        return new EntityManager($connection, $config);
    }
}