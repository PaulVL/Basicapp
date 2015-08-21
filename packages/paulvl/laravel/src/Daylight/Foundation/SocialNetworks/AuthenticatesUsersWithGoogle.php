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

trait AuthenticatesUsersWithGoogle
{   

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    public function getGoogle()
    {
        if( !method_exists($this, 'createFromGoogleUser') ) {
            throw new BadFunctionCallException("'createFromGoogleUser' method does not exists on ".get_class($this));
        }
        // return Socialite::driver('google')->redirect();
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function getGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        Auth::login($this->createFromGoogleUser($user));

        return redirect($this->redirectPath()->with('status', 'Logged in with Google.'));
    }

}
