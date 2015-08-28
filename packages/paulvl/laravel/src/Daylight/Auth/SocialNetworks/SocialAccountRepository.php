<?php

namespace Daylight\Auth\SocialNetworks;

use Daylight\Model\SocialAccounts

class SocialAccountRepository
{
	protected $provider;

	public function __construct($provider)
	{
		$this->provider = $provider;
	}
}