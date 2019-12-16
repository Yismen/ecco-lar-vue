<?php

namespace App\Repositories;

use App\Supervisor;
use App\SupervisorUser;
use App\User;

class SupervisorUsersRepository
{
    public function data()
    {
        return [
            'assigned' => $this->assigned(), 
            'free_users' => $this->freeUsers(), 
            'free_supervisors' => $this->freeSupervisors()
        ];
    }

    public function assigned()
    {
        return User::whereHas('supervisors')
            ->with('supervisors', 'roles')
            ->get();
    }

    public function freeUsers()
    {
        return User::with('roles')
            ->get();
    }

    public function freeSupervisors()
    {
        return Supervisor::whereDoesntHave('users')
            ->actives()
            ->get();
    }
}