<?php

require __DIR__ . '/../vendor/autoload.php';

class_alias('Styde\AccessHandler', 'Access');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$container = Styde\Container::getInstance();

$container->singleton('session', function ($app) {
    $data = array(
        'user_data' => array(
            'name' => 'Duilio',
            'role' => 'teacher'
        )
    );

    $driver = new Styde\SessionArrayDriver($data);

    return new Styde\SessionManager($driver);
});

$container->singleton(Styde\AuthenticatorInterface::class, function ($app) {
    return new Styde\Authenticator($app->make('session'));
});

$container->singleton('access', function ($app) {
    return $app->build(Styde\AccessHandler::class);
});