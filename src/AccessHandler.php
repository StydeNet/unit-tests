<?php

namespace Styde;

class AccessHandler
{
    /**
     * @var \Styde\AuthenticatorInterface
     */
    protected $auth;

    /**
     * @param \Styde\AuthenticatorInterface $auth
     */
    public function __construct(AuthenticatorInterface $auth)
    {
        $this->auth = $auth;
    }

    public function check($role)
    {
        return $this->auth->check() && $this->auth->user()->role === $role;
    }

}