<?php

declare(strict_types=1);

use Symfony\Config\WebProfilerConfig;

return static function (WebProfilerConfig $webProfiler) {
    $webProfiler->toolbar(false);
    $webProfiler->interceptRedirects(false);
};
