<?php

require(__DIR__.'/../bootstrap/start.php');

function homeController()
{
    view('index', compact('access'));
}

homeController();