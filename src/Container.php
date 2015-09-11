<?php

namespace Styde;

use Closure;
use InvalidArgumentException;
use ReflectionClass;
use ReflectionException;

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
            $object = $this->build($resolver);
        }

        return $object;
    }

    public function build($name)
    {
        $reflection = new ReflectionClass($name);

        if(!$reflection->isInstantiable()) {
            throw new InvalidArgumentException("$name is not instantiable");
        }

        $constructor = $reflection->getConstructor(); //ReflectionMethod

        if(is_null($constructor)) {
            return new $name;
        }

        $constructorParameters = $constructor->getParameters(); //[ReflectionParameter]

        $arguments = array();

        foreach ($constructorParameters as $constructorParameter) {

            try {
                $parameterClassName = $constructorParameter->getClass()->getName();
            } catch(ReflectionException $e) {
                throw new ContainerException("Unable to build [$name]: " . $e->getMessage(), null, $e);
            }

            $arguments[] = $this->build($parameterClassName);
        }

        // new Foo($bar)
        return $reflection->newInstanceArgs($arguments);
    }

}