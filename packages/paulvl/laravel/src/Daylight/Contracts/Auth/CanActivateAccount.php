<?php

namespace Daylight\Contracts\Auth;

interface CanActivateAccount
{
    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForAccountActivation();
}
