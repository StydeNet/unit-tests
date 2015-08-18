<?php

use Styde\AccessHandler as Access;
use Styde\Authenticator as Auth;
use Styde\SessionArrayDriver;
use Styde\SessionFileDriver;
use Styde\SessionManager as Session;
use Styde\Stubs\AuthenticatorStub;

class AccessHandlerTest extends PHPUnit_Framework_TestCase
{

    public function test_grant_access()
    {
        $auth = new AuthenticatorStub();
        $access = new Access($auth);

        $this->assertTrue(
            $access->check('admin')
        );
    }

    public function test_deny_access()
    {
        $auth = new AuthenticatorStub();
        $access = new Access($auth);

        $this->assertFalse(
            $access->check('editor')
        );
    }

}