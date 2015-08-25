<?php

require(__DIR__.'/../bootstrap/start.php');

function studentController()
{
    if (!$access->check('student')) {
        abort404();
    }

    view('students', compact('access'));
}

return studentController();