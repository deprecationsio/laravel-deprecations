<?php

namespace Deprecationsio\Laravel;

use Deprecationsio\Monolog\MonologHandlerClassNameResolver;
use Illuminate\Log\LogManager;
use Illuminate\Support\ServiceProvider;
use Monolog\Logger as Monolog;

class DeprecationsioProvider extends ServiceProvider
{
    public function boot()
    {
        $logManager = app()->get('log');

        if ($logManager instanceof LogManager) {
            $logManager->extend('deprecationsio', function($app, $config) {
                $handlerName = MonologHandlerClassNameResolver::resolveHandlerClassName();

                return new Monolog('deprecationsio', [new $handlerName($config['dsn'])]);
            });
        }
    }
}
