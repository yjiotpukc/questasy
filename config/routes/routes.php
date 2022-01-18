<?php

declare(strict_types=1);

use Game\Presentation\Controller\GameController;
use Game\Presentation\Controller\HomeController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routing) {
    $routing->add('home', '/')->methods(['GET'])->controller([HomeController::class, 'home']);
    $routing->add('game', '/game')->methods(['GET'])->controller([GameController::class, 'questProgress']);
    $routing->add('startQuest', '/game/start-quest')->methods(['POST'])->controller([GameController::class, 'startQuest']);
    $routing->add('progressQuest', '/game/progress-quest')->methods(['POST'])->controller([GameController::class, 'progressQuest']);
    $routing->add('finishQuest', '/game/finish-quest')->methods(['POST'])->controller([GameController::class, 'finishQuest']);
    $routing->add('resetWalkthrough', '/game/reset-walkthrough')->methods(['GET'])->controller([GameController::class, 'resetWalkthrough']);
    $routing->add('resetShipQuest', '/game/reset-ship-quest')->methods(['GET'])->controller([GameController::class, 'resetShipQuest']);
};
