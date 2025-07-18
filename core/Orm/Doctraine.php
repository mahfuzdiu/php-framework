<?php

namespace Core\Orm;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class Doctraine
{
    public  function __construct(private $databaseConfig, private $isDevMode = true){}

    public function getEntityManager(): EntityManager
    {
        $config = ORMSetup::createAttributeMetadataConfig(paths: [__DIR__ . '/../../app/Models'], isDevMode: $this->isDevMode,);
        //database connection
        $connection = DriverManager::getConnection($this->databaseConfig, $config);
        return new EntityManager($connection, $config);
    }
}