<?php

use Styde\Container;

function view($template, array $vars = array())
{
    extract($vars);

    $path = __DIR__ . '/../views/';

    ob_start();

    require ($path . $template . '.php');

    $templateContent = ob_get_clean();

    require ($path . 'layout.php');
}

function abort404()
{
    $access = Container::getInstance()->make('access');

    http_response_code(404);
    view('page404', compact('access'));
    exit();
}