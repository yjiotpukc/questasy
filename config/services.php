<?php

declare(strict_types=1);

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Utils\DependencyInjection\DocumentManagerFactory;

return static function (ContainerConfigurator $container) {
    $services = $container->services();

    $services->defaults()->autoconfigure()->autowire();

    $services
        ->load('Utils\\', '../src/Utils/')
        ->load('Game\\', '../src/Game/')
        ->exclude('../src/Game/Domain/Entity');

    $services->set(DocumentManager::class)
        ->factory([DocumentManagerFactory::class, 'createDocumentManager'])
        ->args(['%kernel.cache_dir%']);
};
