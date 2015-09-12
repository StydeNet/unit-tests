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

    public function make($name, array $arguments = array())
    {
        if (isset ($this->shared[$name]))
        {
            return $this->shared[$name];
        }

        if (isset ($this->bindings[$name])) {
            $resolver = $this->bindings[$name]['resolver'];
        } else {
            $resolver = $name;
        }

        if ($resolver instanceof Closure) {
            $object = $resolver($this);
        } else {
            $object = $this->build($resolver, $arguments);
        }

        return $object;
    }

    public function build($name, array $arguments = array())
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

        $dependencies = array();

        foreach ($constructorParameters as $constructorParameter) {

            $parameterName = $constructorParameter->getName();

            if (isset ($arguments[$parameterName])) {
                $dependencies[] = $arguments[$parameterName];
                continue;
            }

            try {
                $parameterClass = $constructorParameter->getClass();
            } catch(ReflectionException $e) {
                throw new ContainerException("Unable to build [$name]: " . $e->getMessage(), null, $e);
            }

            if ($parameterClass!=null) {
                $parameterClassName = $parameterClass->getName();
                $dependencies[] = $this->build($parameterClassName);
            } else {



                throw new ContainerException("Please provide the value of the parameter [$parameterName]");
            }
        }

        // new Foo($bar) or MailDummy('url', 'key')
        return $reflection->newInstanceArgs($dependencies);
    }

}