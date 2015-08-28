<?php

namespace Daylight\Foundation\SocialNetworks;

use BadFunctionCallException;
use Socialite;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait HandleSocialNetwork
{
    /**
     * Redirect the user to the Providers authentication page.
     *
     * @return Response
     */
    public function getIndex()
    {
        if( !method_exists($this, 'create') ) {
            throw new BadFunctionCallException("'create' method does not exists on ".get_class($this));
        }
        return Socialite::driver($this->provider)->redirect();
    }

    /**
     * Obtain the user information from Provider.
     *
     * @return Response
     */
    public function getCallback()
    {
        $user = Socialite::driver($this->provider)->user();
        return dd($this->repository->create($user));
        Auth::login($this->repository->create($user));
        return redirect($this->redirectPath())->with('status', 'Logged in with Google.');
    }

    public function create($user)
    {
        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'verified' => $user->user['verified']
            // 'password' => bcrypt($data['password']),
        ]);
    }

}
