<?php

namespace Daylight\Contracts\SocialNetworks;

interface CanAuthenticateWithFacebook
{
    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function createFromFacebookUser($user);
}
