<?php

require(__DIR__.'/../bootstrap/start.php');

function teacherController()
{
    if (!$access->check('teacher')) {
        abort404();
    }

    view('teachers', compact('access'));
}

teacherController();