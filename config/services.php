<?php

declare(strict_types=1);

use App\DocumentManagerFactory;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $services = $container->services();

    $services->defaults()->autoconfigure()->autowire();

    $services->load('App\\', '../src/')
        ->exclude('../src/DependencyInjection')
        ->exclude('../src/Entity/')
        ->exclude('../src/Kernel.php');

    $services->set(DocumentManager::class)
        ->factory([DocumentManagerFactory::class, 'createDocumentManager'])
        ->args(['%kernel.cache_dir%']);
};
