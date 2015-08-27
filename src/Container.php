<?php

namespace Styde;

use Closure;

class Container
{

    protected $shared = [];
    protected $bindings = [];

    public function bind($name, $resolver)
    {
        $this->bindings[$name] = [
            'resolver' => $resolver
        ];
    }

    public function instance($name, $object)
    {
        $this->shared[$name] = $object;
    }

    public function make($name)
    {
        if (isset ($this->shared[$name]))
        {
            return $this->shared[$name];
        }

        $resolver = $this->bindings[$name]['resolver'];

        if ($resolver instanceof Closure) {
            $object = $resolver($this);
        } else {
            $object = new $resolver;
        }

        return $object;
    }

}