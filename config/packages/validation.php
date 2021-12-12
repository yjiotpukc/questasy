<?php

declare(strict_types=1);

use Symfony\Config\FrameworkConfig;

return static function (FrameworkConfig $framework) {
    $framework->validation()->emailValidationMode('html5');
};
