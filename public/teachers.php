<?php

require(__DIR__.'/../bootstrap/start.php');

function teacherController()
{
    if (!Access::check('teacher')) {
        abort404();
    }

    view('teachers');
}

teacherController();