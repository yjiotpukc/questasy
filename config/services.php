<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $services = $container->services();

    $services->defaults()->autoconfigure()->autowire();

    $services->load('App\\', '../src/')
        ->exclude('../src/DependencyInjection')
        ->exclude('../src/Entity/')
        ->exclude('../src/Kernel.php');
};
