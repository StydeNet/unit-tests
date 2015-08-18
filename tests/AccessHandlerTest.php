<?php

use Styde\AccessHandler as Access;
use Styde\Authenticator;
use Styde\AuthenticatorInterface;
use Styde\User;

class AccessHandlerTest extends PHPUnit_Framework_TestCase
{

    public function tearDown()
    {
        Mockery::close();
    }

    public function test_grant_access()
    {
        $access = new Access($this->getAuthenticatorMock());

        $this->assertTrue(
            $access->check('admin')
        );
    }

    public function test_deny_access()
    {
        $access = new Access($this->getAuthenticatorMock());

        $this->assertFalse(
            $access->check('editor')
        );
    }

    protected function getAuthenticatorMock()
    {
        $user = Mockery::mock(User::class);
        $user->role = 'admin';

        $auth = Mockery::mock(Authenticator::class);
        $auth->shouldReceive('check')
            ->once()
            ->andReturn(true);
        $auth->shouldReceive('user')
            ->once()
            ->andReturn($user);

        return $auth;
    }

}