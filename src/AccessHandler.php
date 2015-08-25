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

    public function check($roles)
    {
        if (!is_array($roles)) {
            $roles = explode('|', $roles);
        }

        return $this->auth->check() && in_array($this->auth->user()->role, $roles);
    }

}