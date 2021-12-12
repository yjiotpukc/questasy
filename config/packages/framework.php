<?php

declare(strict_types=1);

use Symfony\Config\FrameworkConfig;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

return static function (FrameworkConfig $framework) {
    $framework->secret(env('APP_SECRET'));
    $framework->csrfProtection();
    $framework->httpMethodOverride(true);
    $framework->session()
        ->handlerId(null)
        ->cookieSecure('auto')
        ->cookieSamesite('lax')
        ->storageFactoryId('session.storage.factory.native');
    $framework->phpErrors()->log();

};
