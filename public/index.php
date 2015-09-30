<?php

use Styde\Container;

require(__DIR__.'/../bootstrap/start.php');

function homeController()
{
    $access = Container::getInstance()->make('access');

    view('index', compact('access'));
}

homeController();