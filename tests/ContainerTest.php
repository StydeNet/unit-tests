<?php

use Styde\Container;

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

        $container->bind('key', 'Foo');

        $this->assertInstanceOf('Foo', $container->make('key'));
    }

}

class Foo {

    public function __construct(Bar $bar)
    {
    }

}

class Bar {

}