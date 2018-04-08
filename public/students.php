<?php

require(__DIR__.'/../bootstrap/start.php');

function studentController()
{
    if (!Access::check('student')) {
        abort404();
    }

    view('students');
}

return studentController();