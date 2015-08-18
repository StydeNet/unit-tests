<?php

use Styde\AccessHandler as Access;
use Styde\Authenticator as Auth;
use Styde\SessionFileDriver;
use Styde\SessionManager as Session;

class AccessHandlerTest extends PHPUnit_Framework_TestCase
{

    public function test_grant_access()
    {
        $driver = new SessionFileDriver();
        $session = new Session($driver);
        $auth = new Auth($session);
        $access = new Access($auth);

        $this->assertTrue(
            $access->check('admin')
        );
    }

    public function test_deny_access()
    {
        $driver = new SessionFileDriver();
        $session = new Session($driver);
        $auth = new Auth($session);
        $access = new Access($auth);

        $this->assertFalse(
            $access->check('editor')
        );
    }

}