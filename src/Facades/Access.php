<?php

namespace Styde\Facades;

use Styde\Container\Facade;

class Access extends Facade
{

    public static function getAccessor()
    {
        return 'access';
    }

}