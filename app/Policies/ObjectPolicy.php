<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Object;
use Illuminate\Auth\Access\HandlesAuthorization;

class ObjectPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the object.
     *
     * @param  \App\User  $user
     * @param  \App\Object  $object
     * @return mixed
     */
    public function view(User $user, Object $object)
    {
        if ($user->hasAccessToObject($object)) { return true; }
        return false;
    }

    /**
     * Determine whether the user can create objects.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the object.
     *
     * @param  \App\User  $user
     * @param  \App\Object  $object
     * @return mixed
     */
    public function update(User $user, Object $object)
    {
        //
    }

    /**
     * Determine whether the user can delete the object.
     *
     * @param  \App\User  $user
     * @param  \App\Object  $object
     * @return mixed
     */
    public function delete(User $user, Object $object)
    {
        //
    }
}
