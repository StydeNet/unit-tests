<?php

use Styde\Container;

require(__DIR__.'/../bootstrap/start.php');

function teacherController()
{
    $access = Container::getInstance()->access();

    if (!$access->check('teacher')) {
        abort404();
    }

    view('teachers', compact('access'));
}

teacherController();