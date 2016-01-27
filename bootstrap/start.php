<?php

use Styde\Container\Application;
use Styde\Container\Facade;
use Styde\Container\Container;
use Styde\MyApplication;

require __DIR__ . '/../vendor/autoload.php';

class_alias('Styde\Facades\Access', 'Access');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$container = Container::getInstance();

Facade::setContainer($container);

$application = new MyApplication($container);

$application->registerProviders(array(
    Styde\Providers\SessionProvider::class,
    Styde\Providers\AuthenticatorProvider::class,
    Styde\Providers\AuthorizationProvider::class
));