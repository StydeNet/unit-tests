<?php


namespace Styde;

class SessionManager
{

    protected static $loaded = false;
    protected static $data = array();

    protected static function load()
    {
        if (static::$loaded) return;

        static::$data = SessionFileDriver::load();

        static::$loaded = true;
    }

    public static function get($key)
    {
        static::load();

        return isset(static::$data[$key])
            ? static::$data[$key]
            : null;
    }

}