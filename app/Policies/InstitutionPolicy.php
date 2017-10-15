<?php

namespace App\Policies;

use App\Model\User;
use App\Model\Institution;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstitutionPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the institution.
     *
     * @param  \App\User  $user
     * @param  \App\Institution  $institution
     * @return mixed
     */
    public function view(User $user, Institution $institution)
    {
        if ($user->hasAccessToInstitution($institution)) { return true; }
        return false;
    }

    /**
     * Determine whether the user can create institutions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the institution.
     *
     * @param  \App\User  $user
     * @param  \App\Institution  $institution
     * @return mixed
     */
    public function update(User $user, Institution $institution)
    {
        //
    }

    /**
     * Determine whether the user can delete the institution.
     *
     * @param  \App\User  $user
     * @param  \App\Institution  $institution
     * @return mixed
     */
    public function delete(User $user, Institution $institution)
    {
        //
    }
}
