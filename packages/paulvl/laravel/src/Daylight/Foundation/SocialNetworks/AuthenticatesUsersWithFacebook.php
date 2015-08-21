<?php

namespace Daylight\Foundation\SocialNetworks;

use BadFunctionCallException;
use Socialite;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Daylight\Support\Facades\Confirmation;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait AuthenticatesUsersWithFacebook
{   

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function getFacebook()
    {
        if( !method_exists($this, 'createFromFacebookUser') ) {
            throw new BadFunctionCallException("'createFromFacebookUser' method does not exists on ".get_class($this));
        }
        // return Socialite::driver('facebook')->redirect();
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function getFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        Auth::login($this->createFromFacebookUser($user));

        return redirect($this->redirectPath()->with('status', 'Logged in with Facebook.'));
    }

}
