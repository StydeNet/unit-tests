<?php


namespace Styde;

class SessionManager
{
    protected $driver;
    protected $data = array();

    public function __construct(SessionDriverInterface $driver)
    {
        $this->driver = $driver;

        $this->load();
    }

    protected function load()
    {
        $this->data = $this->driver->load();
    }

    public function get($key)
    {
        return isset($this->data[$key])
            ? $this->data[$key]
            : null;
    }

}