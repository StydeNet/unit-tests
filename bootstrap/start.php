<?php

require __DIR__ . '/../vendor/autoload.php';

class_alias('Styde\AccessHandler', 'Access');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$data = array(
    'user_data' => array(
        'name' => 'Duilio',
        'role' => 'teacher'
    )
);

$driver = new \Styde\SessionArrayDriver($data);
$session = new \Styde\SessionManager($driver);
$auth = new \Styde\Authenticator($session);
$access = new \Styde\AccessHandler($auth);