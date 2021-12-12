<?php

declare(strict_types=1);

use Symfony\Config\TwigConfig;

return static function (TwigConfig $twig) {
    $twig->defaultPath('%kernel.project_dir%/templates');
    $twig->strictVariables(true);
};
