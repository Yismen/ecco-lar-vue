<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DashboardPolicy
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

    public function viewAny(User $user)
    {
        return $user->hasAnyPermission(['view-dashboards']);
    }

    public function view(User $user)
    {
        return $user->hasAnyPermission(['view-dashboards']);
    }
}
