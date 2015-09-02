<?php

namespace Basicapp\Http\Controllers\Auth;

use Daylight\Routing\GoogleAuthController as GoogleController;
use Basicapp\User;

class GoogleAuthController extends GoogleController
{
    public function create($callbackData)
    {
        return User::create([
            'name' => $callbackData->name,
            'email' => $callbackData->email,
            'avatar' => $callbackData->avatar,
            'verified' => true
        ]);
    }
}
