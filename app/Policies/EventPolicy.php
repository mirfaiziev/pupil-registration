<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    public function any(User $user)
    {
        return in_array($user->role, [
            User::USER_ROLE_SUPER_ADMIN,
            User::USER_ROLE_ADMIN,
            User::USER_ROLE_SET_RESULTS,
        ]);
    }
}
