<?php

declare(strict_types=1);

use Symfony\Config\MonologConfig;

return static function (MonologConfig $monolog) {
    $mainHandler = $monolog->handler('main');
    $mainHandler
        ->type('fingers_crossed')
        ->actionLevel('error')
        ->handler('nested')
        ->channels()
        ->elements(['!event']);
    $mainHandler->excludedHttpCode()->code(404);
    $mainHandler->excludedHttpCode()->code(405);

    $monolog->handler('nested')
        ->type('stream')
        ->path('%kernel.logs_dir%/%kernel.environment%.log')
        ->level('debug');
};
