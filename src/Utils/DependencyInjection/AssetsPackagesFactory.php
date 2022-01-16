<?php

declare(strict_types=1);

namespace Utils\DependencyInjection;

use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Asset\PathPackage;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\Asset\VersionStrategy\JsonManifestVersionStrategy;

class AssetsPackagesFactory
{
    public static function createAssetsPackages(string $projectDir): Packages
    {
        $publicDir = $projectDir . '/public/';
        $defaultPackage = new Package(new JsonManifestVersionStrategy($publicDir . 'build/manifest.json'));
        $namedPackages = [
            'images' => new PathPackage('/images', new EmptyVersionStrategy()),
        ];

        return new Packages($defaultPackage, $namedPackages);
    }
}
