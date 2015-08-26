<?php

use Styde\Container;

require(__DIR__.'/../bootstrap/start.php');

function studentController()
{
    $access = Container::getInstance()->access();

    if (!$access->check('student')) {
        abort404();
    }

    view('students', compact('access'));
}

return studentController();