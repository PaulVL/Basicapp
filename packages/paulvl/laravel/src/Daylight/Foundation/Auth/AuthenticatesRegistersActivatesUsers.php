<?php

namespace Daylight\Foundation\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

trait AuthenticatesRegistersActivatesUsers
{
    use AuthenticatesUsers, RegistersUsers, ActivatesAccounts {
        AuthenticatesUsers::redirectPath insteadof RegistersUsers;
        AuthenticatesUsers::redirectPath insteadof ActivatesAccounts;
        AuthenticatesUsers::loginPath insteadof ActivatesAccounts;
    }
}
