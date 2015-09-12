<?php

use Styde\Container;
use Styde\ContainerException;

class ContainerTest extends PHPUnit_Framework_TestCase
{

    public function test_bind_from_closure()
    {
        $container = new Container();

        $container->bind('key', function () {
            return 'Object';
        });

        $this->assertSame('Object', $container->make('key'));
    }

    public function test_bind_instance()
    {
        $container = new Container();

        $stdClass = new StdClass();

        $container->instance('key', $stdClass);

        $this->assertSame($stdClass, $container->make('key'));
    }

    public function test_bind_from_class_name()
    {
        $container = new Container();

        $container->bind('key', 'StdClass');

        $this->assertInstanceOf('StdClass', $container->make('key'));
    }

    public function test_bind_with_automatic_resolution()
    {
        $container = new Container();

        $container->bind('foo', 'Foo');

        $this->assertInstanceOf('Foo', $container->make('foo'));
    }

    /**
     * @expectedException Styde\ContainerException
     * @expectedExceptionMessage Unable to build [Qux]: Class Norf does not exist
     */
    public function test_expected_container_exception_if_dependency_does_not_exist()
    {
        $container = new Container();

        $container->bind('qux', 'Qux');

        $container->make('qux');
    }

    /**
     * Quita el prefijo exercise_ para ejecutar la prueba
     *
     * @expectedException Styde\ContainerException
     */
    public function exercise_test_class_does_not_exist()
    {
        $container = new Container();

        $container->bind('norf', 'Norf');

        $container->make('norf');
    }

}

class Foo {

    public function __construct(Bar $bar, Baz $baz)
    {
    }

}

class Bar {

    public function __construct(FooBar $fooBar)
    {
    }

}

class FooBar {

}

class Baz {

}

class Qux {

    public function __construct(Norf $norf)
    {
    }

}