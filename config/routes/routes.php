<?php

declare(strict_types=1);

use Game\Presentation\Controller\HomeController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routing) {
    $routing->add('home', '/')->controller([HomeController::class, 'home']);
};
