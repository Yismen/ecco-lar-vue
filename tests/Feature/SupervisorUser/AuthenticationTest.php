<?php

namespace Tests\Feature\SupervisorUsers;

use App\Supervisor;
use App\SupervisorUser;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testGuestCantViewSupervisorUsers()
    {
        $user = create('App\User');
        $supervisor = create('App\Supervisor');
        
        $this->get(route('admin.supervisor_users.index'))->assertRedirect('/login');
    }

    public function testGuestCantEditSupervisorUsers()
    {
        $user = create(User::class);
        $supervisor = create(Supervisor::class);
        $user->supervisors()->sync((array) $supervisor->id);

        $supervisor_user = SupervisorUser::where('user_id', $user->id)->where('supervisor_id', $supervisor->id)->first();

        $this->put(route('admin.supervisor_users.update', $supervisor_user->id))->assertRedirect('/login');
    }

    public function testGuestCantDestroySupervisorUser()
    {
        $user = create(User::class);
        $supervisor = create(Supervisor::class);
        $user->supervisors()->sync((array) $supervisor->id);

        $supervisor_user = SupervisorUser::where('user_id', $user->id)->where('supervisor_id', $supervisor->id)->first();

        $this->delete(route('admin.supervisor_users.destroy', $supervisor_user->id))->assertRedirect('/login');
    }
}
