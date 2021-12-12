<?php

declare(strict_types=1);

use Symfony\Config\FrameworkConfig;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

return static function (FrameworkConfig $framework) {
    $framework->mailer()->dsn(env('MAILER_DSN'));
};
