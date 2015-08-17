<?php

namespace Daylight\Auth\Accounts;

trait CanActivateAccount
{
    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForAccountActivation()
    {
        return $this->email;
    }
}
