<?php

namespace Daylight\Contracts\SocialNetworks;

interface HandleSocialNetwork
{
	public function getIndex();

	public function getCallback();

	public function create($user);
}
