<?php

declare(strict_types=1);

use Game\Presentation\Controller\GameController;
use Game\Presentation\Controller\HomeController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routing) {
    $routing->add('home', '/')->methods(['GET'])->controller([HomeController::class, 'home']);
    $routing->add('game', '/game')->methods(['GET'])->controller([GameController::class, 'questProgress']);
};
