<?php

namespace Styde;

use Styde\Authenticator as Auth;

class AccessHandler
{

    public static function check($role)
    {
        return Auth::check() && Auth::user()->role === $role;
    }

}