<?php

namespace Styde;

interface AuthenticatorInterface
{

    /**
     * @return boolean
     */
    public function check();

    /**
     * @return \Styde\User
     */
    public function user();

}