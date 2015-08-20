<?php

namespace Daylight\Foundation\SocialNetworks;

use Socialite;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Daylight\Support\Facades\Confirmation;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Daylight\Contracts\Auth\CanConfirmAccount as CanConfirmAccountContract;

trait AuthenticatesUsersWithFacebook
{   

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function getFacebook()
    {
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

        return dd($user);

        Auth::login($this->create($user));

        return redirect($this->redirectPath());
    }
}
