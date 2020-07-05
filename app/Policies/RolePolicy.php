<?php

namespace App\Policies;

use App\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user can action on role.
     *
     * @param  \App\User  $user
     * @param  \App\Role  $role
     * @return bool
     */
    public function accessToRole(User $user, Role $role)
    {

        if ($role->name === 'platform-contributor') {
            return $user->roles->contains('name','platform-admin');
        }

        if ($role->name === 'entity-admin') {
            return
                $user->roles->contains('name','platform-admin') ||
                $user->roles->contains('name','platform-contributor');
        }

        if ($role->name === 'resource-owner' || $role->name === 'resource-contributor' ) {
            return $user->roles->contains('name', 'entity-admin');
        }

    }
}
