<?php

declare(strict_types=1);

use Symfony\Config\MonologConfig;

return static function (MonologConfig $monolog) {
    $mainHandler = $monolog->handler('main');
    $mainHandler->type('fingers_crossed')
        ->actionLevel('error')
        ->handler('nested')
        ->bufferSize(50);
    $mainHandler->excludedHttpCode()->code(404);
    $mainHandler->excludedHttpCode()->code(405);

    $monolog->handler('nested')
        ->type('stream')
        ->path('php://stderr')
        ->level('debug')
        ->formatter('monolog.formatter.json');
    $monolog->handler('console')
        ->type('console')
        ->processPsr3Messages(false)
        ->channels()
        ->elements(['!event', '!doctrine']);
};
