<?php


namespace Styde\Providers;

use Styde\Authenticator;
use Styde\AuthenticatorInterface;
use Styde\Container\Provider;

class AuthenticatorProvider extends Provider
{

    public function register()
    {
        $this->container->singleton(AuthenticatorInterface::class, function ($app) {
            return new Authenticator($app->make('session'));
        });
    }
}