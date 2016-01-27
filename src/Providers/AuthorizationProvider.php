<?php


namespace Styde\Providers;

use Styde\AccessHandler;
use Styde\Container\Provider;

class AuthorizationProvider extends Provider
{

    public function register()
    {
        $this->container->singleton('access', function ($app) {
            return $app->build(AccessHandler::class);
        });
    }
}