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
        $role = is_array($roles) ? in_array($this->auth->user()->role, $roles) : in_array($this->auth->user()->role, explode('|', $roles));
        
        return $this->auth->check() && ($role);
    }

}