<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function any(User $user)
    {
        return $user->role == User::USER_ROLE_SUPER_ADMIN;
    }
}
