<?php

namespace Daylight\Auth\SocialNetworks;

trait CanLoginWithFacebook
{
    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForFacebookLogin()
    {
        return $this->email;
    }
}
