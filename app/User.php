<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const USER_ROLE_SUPER_ADMIN = 'super_admin';
    const USER_ROLE_ADMIN = 'admin';
    const USER_ROLE_CONFIRM_PRESENTS = 'confirm_presets';
    const USER_ROLE_SET_RESULTS = 'set_results';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getAvailableRoles()
    {
        return [
            self::USER_ROLE_ADMIN,
            self::USER_ROLE_SET_RESULTS,
            self::USER_ROLE_CONFIRM_PRESENTS,
        ];
    }
}
