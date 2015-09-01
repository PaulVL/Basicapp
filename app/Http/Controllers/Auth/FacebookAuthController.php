<?php

namespace Basicapp\Http\Controllers\Auth;

use Daylight\Routing\FacebookAuthController as FacebookController;
use Basicapp\User;

class FacebookAuthController extends FacebookController
{
    public function create($callbackData)
    {
        return User::create([
            'name' => $callbackData->name,
            'email' => $callbackData->email,
            'avatar' => $callbackData->avatar,
            'verified' => $callbackData->user['verified']
        ]);
    }
}
