<?php

declare(strict_types=1);

namespace Utils\DependencyInjection;

use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use MongoDB\Client;
use yjiotpukc\MongoODMFluent\FluentDriver;
use yjiotpukc\MongoODMFluent\MappingFinder\DirectoryMappingFinder;

class DocumentManagerFactory
{
    public static function createDocumentManager(string $cacheDir): DocumentManager
    {
        $config = new Configuration();
        $config->setProxyDir("{$cacheDir}/doctrine/odm/mongodb/Proxies");
        $config->setProxyNamespace('MongoDBODMProxies');
        $config->setHydratorDir("{$cacheDir}/doctrine/odm/mongodb/Hydrators");
        $config->setHydratorNamespace('Hydrators');
        $config->setPersistentCollectionDir("{$cacheDir}/doctrine/odm/mongodb/PersistentCollections");
        $config->setDefaultDB('questasy');

        $mappingFinder = new DirectoryMappingFinder([__DIR__ . '/Game/Infrastructure/Mapping'], ['Game\\Infrastructure\\Mapping']);
        $fluentDriver = new FluentDriver($mappingFinder);
        $config->setMetadataDriverImpl($fluentDriver);

        $client = new Client('mongodb://127.0.0.1', [
            'authSource' => 'questasy',
            'username' => 'questasy',
            'password' => 'questasy',
        ], ['typeMap' => DocumentManager::CLIENT_TYPEMAP]);

        return DocumentManager::create($client, $config);
    }
}