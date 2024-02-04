<?php

/*
 * This file is part of the deprecations.io project.
 *
 * (c) Titouan Galopin <titouan@deprecations.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Deprecationsio\Laravel;

use Deprecationsio\Laravel\DeprecationsioProvider;
use Illuminate\Foundation\Application;
use Illuminate\Log\LogManager;
use PHPUnit\Framework\TestCase;

class DeprecationsioProviderTest extends TestCase
{
    public function testBootCreatesService()
    {
        $app = new Application();
        $app['config'] = [
            'logging' => [
                'default' => 'single',
                'channels' => [
                    'single' => [
                        'driver' => 'single',
                        'path' => storage_path('logs/laravel.log'),
                        'level' => 'debug',
                    ],
                    'deprecations' => [
                        'driver' => 'deprecationsio',
                        'dsn' => 'https://ingest.deprecations.io/?apikey=e77e2bf34a301c270066f81f3e678f7baa3ebe8ef0f55f99bcd00660001bd179',
                    ],
                    'emergency' => [
                        'path' => storage_path('logs/laravel.log'),
                    ],
                ],
            ],
        ];

        $logManager = new LogManager($app);
        app()->bind('log', static function () use ($logManager) {
            return $logManager;
        });

        $provider = new DeprecationsioProvider($app);
        $provider->boot();

        dump($logManager->channel('deprecations'));
    }
}
