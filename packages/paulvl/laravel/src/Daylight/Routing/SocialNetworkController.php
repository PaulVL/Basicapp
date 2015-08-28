<?php

namespace Daylight\Routing;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Daylight\Database\Repositories\SocialAccountRepository;
use Daylight\Contracts\SocialNetworks\HandleSocialNetwork as HandleSocialNetworkContract;
use Daylight\Foundation\SocialNetworks\HandleSocialNetwork as HandleSocialNetwork;

abstract class SocialNetworkController extends BaseController implements HandleSocialNetworkContract
{
    use DispatchesJobs, ValidatesRequests, HandleSocialNetwork;

	protected $provider;

	protected $repository;

    public function __construct()
    {
    	$this->repository = new SocialAccountRepository;
    }
}
