<?php

use Styde\Application;

require __DIR__ . '/../vendor/autoload.php';

class_alias('Styde\Facades\Access', 'Access');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$container = Styde\Container::getInstance();

Styde\Facades\Facade::setContainer($container);

$application = new Application($container);

//$application->register();

$application->registerProviders(array(
    Styde\Providers\SessionProvider::class,
    Styde\Providers\AuthenticatorProvider::class,
    Styde\Providers\AuthorizationProvider::class
));