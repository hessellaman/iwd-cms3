<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

// Policies zorgen voor authorizatie voor een bepaalde model. Gehanteerd op basis van o.a. Build a forum en Whip monstrous code into shape van laracasts.

class ManageUsersPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function manageUsers(User $user) {
        return $user->hasRole('admin');
    }

    public function delete(User $user)
    {
        return $user->id;
    }
}
