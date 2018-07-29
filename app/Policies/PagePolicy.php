<?php

namespace App\Policies;

use App\User;
use App\Page;
use Illuminate\Auth\Access\HandlesAuthorization;

// Policies zorgen voor authorizatie voor een bepaalde model. Gehanteerd op basis van o.a. Build a forum en Whip monstrous code into shape van laracasts.

class PagePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability) {
        if ($user->isAdminOrEditor()) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the page.
     *
     * @param  \App\User  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function update(User $user, Page $page)
    {
        return $user->id == $page->user_id;
    }

    /**
     * Determine whether the user can delete the page.
     *
     * @param  \App\User  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function delete(User $user, Page $page)
    {
        return $user->id == $page->user_id;
    }
}
