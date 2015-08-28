<?php

namespace Daylight\Routing;

class FacebookAuthController extends SocialNetworkController
{
    public function __construct()
    {
    	parent::__construct();
    	$this->provider = 'facebook';
    }
}
