<?php

namespace Styde\Facades;

use Styde\Container;

class Access
{

    public static function check($roles)
    {
        $access = Container::getInstance()->make('access');
        return $access->check($roles);
    }

}