<?php

namespace Basicapp;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Daylight\Auth\Accounts\CanActivateAccount;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Daylight\Contracts\Auth\CanActivateAccount as CanActivateAccountContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, CanActivateAccountContract
{
    use Authenticatable, CanResetPassword, CanActivateAccount;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
}
