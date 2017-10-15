<?php

namespace App\Policies;

use App\Model\User;
use App\Model\Subdivision;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubdivisionPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the subdivision.
     *
     * @param  \App\User  $user
     * @param  \App\Subdivision  $subdivision
     * @return mixed
     */
    public function view(User $user, Subdivision $subdivision)
    {
        if ($user->hasAccessToSubdivision($subdivision)) { return true; }
        return false;
    }

    /**
     * Determine whether the user can create subdivisions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the subdivision.
     *
     * @param  \App\User  $user
     * @param  \App\Subdivision  $subdivision
     * @return mixed
     */
    public function update(User $user, Subdivision $subdivision)
    {
        //
    }

    /**
     * Determine whether the user can delete the subdivision.
     *
     * @param  \App\User  $user
     * @param  \App\Subdivision  $subdivision
     * @return mixed
     */
    public function delete(User $user, Subdivision $subdivision)
    {
        //
    }
}
