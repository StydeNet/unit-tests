<?php

namespace Styde;

use Styde\SessionManager as Session;

class Authenticator
{

    protected static $user;

    public static function check()
    {
        return static::user() != null;
    }

    public static function user()
    {
        if (static::$user != null) {
            return static::$user;
        }

        $data = Session::get('user_data');

        if ( ! is_null($data)) {
            return static::$user = new User($data);
        }

        return null;
    }

}