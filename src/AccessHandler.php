<?php

namespace Styde;

class AccessHandler
{

    public static function check($role)
    {
        return 'admin' === $role;
    }

}