<?php

namespace App\Routing;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class LegacyRouteProvider
{
    private $scriptsPath;

    public function __construct(string $scriptsPath)
    {
        $this->scriptsPath = $scriptsPath;
    }

    public function getRoutes(): RouteCollection
    {
        $routes = new RouteCollection();

        $finder = (new Finder())
            ->in($this->scriptsPath)
            ->name('*.php');

        /** @var SplFileInfo $file */
        foreach ($finder as $file) {
            $routes->add(
                'legacy.'.$file->getFilename(),
                (new Route('/'.$file->getFilename()))
                    ->setMethods(['GET', 'POST'])
                    ->setDefault('script', $file->getFilename())
            );

            if ('index.php' === $file->getFilename()) {
                $routes->add(
                    'legacy.home',
                    (new Route('/'))
                        ->setMethods(['GET', 'POST'])
                        ->setDefault('script', $file->getFilename())
                );
            }
        }

        return $routes;
    }
}
