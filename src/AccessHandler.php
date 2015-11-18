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
    public function __construct(Authenticator $auth)
    {
        $this->auth = $auth;
    }

    public function check($roles)
    {
        $roles = ! is_array($roles) ? explode('|', $roles) : $roles;

        return $this->auth->check() && in_array($this->auth->user()->role, $roles);
    }

}