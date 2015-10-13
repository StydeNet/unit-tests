<?php

use Styde\Container;

require(__DIR__.'/../bootstrap/start.php');

function homeController()
{
    view('index');
}

homeController();