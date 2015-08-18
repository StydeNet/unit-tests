<?php

namespace Styde\Stubs;

use Styde\User;
use Styde\AuthenticatorInterface;

class AuthenticatorStub implements AuthenticatorInterface
{
    /**
     * @var
     */
    private $logged;

    public function __construct($logged = true)
    {
        $this->logged = $logged;
    }

    public function user()
    {
        return new User([
            'role' => 'admin'
        ]);
    }

    /**
     * @return boolean
     */
    public function check()
    {
        return $this->logged;
    }
}