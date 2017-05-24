<?php

namespace App\Policies;

use App\User;
use App\Model\School;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the school.
     *
     * @param  \App\User         $user
     *
     * @return mixed
     */
    public function any(User $user)
    {
        return in_array($user->role, [User::USER_ROLE_SUPER_ADMIN, User::USER_ROLE_ADMIN]);
    }
}
