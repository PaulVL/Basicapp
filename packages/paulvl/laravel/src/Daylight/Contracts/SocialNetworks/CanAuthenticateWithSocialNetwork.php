<?php

namespace Daylight\Contracts\SocialNetworks;

interface CanAuthenticateWithSocialNetwork
{
    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForSocialNetworkAuthentication();
}
