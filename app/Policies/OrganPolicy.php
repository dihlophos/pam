<?php

namespace App\Policies;

use App\Model\User;
use App\Model\Organ;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        dd($ability);
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the organ.
     *
     * @param  \App\User  $user
     * @param  \App\Organ  $organ
     * @return mixed
     */
    public function view(User $user, Organ $organ)
    {
        if ($user->hasAccessToOrgan($organ)) { return true; }

        return false;
    }

    /**
     * Determine whether the user can create organs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the organ.
     *
     * @param  \App\User  $user
     * @param  \App\Organ  $organ
     * @return mixed
     */
    public function update(User $user, Organ $organ)
    {
        //
    }

    /**
     * Determine whether the user can delete the organ.
     *
     * @param  \App\User  $user
     * @param  \App\Organ  $organ
     * @return mixed
     */
    public function delete(User $user, Organ $organ)
    {
        //
    }
}
