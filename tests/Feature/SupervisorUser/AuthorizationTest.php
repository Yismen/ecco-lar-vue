<?php

namespace Tests\Feature\SupervisorUsers;

use App\Supervisor;
use App\SupervisorUser;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testUnuthorizedUsersCantViewSupervisorUser()
    {
        $user = create('App\User');
        $response = $this->actingAs($this->userWithPermission('wrong-permission'));

        $response->get(route('admin.supervisor_users.index'))
            ->assertForbidden();

        $response->get(route('admin.supervisor_users.show', $user->id))
            ->assertForbidden();
    }

    public function testUnuthorizedUsersCantCreatetSupervisorUser()
    {
        $response = $this->actingAs($this->userWithPermission('wrong-permission'));

        $response->post(route('admin.supervisor_users.store'))
            ->assertForbidden();
    }

    public function testUnuthorizedUsersCantEditSupervisorUser()
    {
        $user = create(User::class);
        $supervisor = create(Supervisor::class);
        $user->supervisors()->sync((array) $supervisor->id);
        $supervisor_user = SupervisorUser::where('user_id', $user->id)->where('supervisor_id', $supervisor->id)->first();

        $response = $this->actingAs($this->userWithPermission('wrong-permission'));

        $response->put(route('admin.supervisor_users.update', $supervisor_user->id))
            ->assertForbidden();
    }

    public function testUnuthorizedUsersCantDestroySupervisorUser()
    {
        $user = create(User::class);
        $supervisor = create(Supervisor::class);
        $user->supervisors()->sync((array) $supervisor->id);
        $supervisor_user = SupervisorUser::where('user_id', $user->id)->where('supervisor_id', $supervisor->id)->first();

        $response = $this->actingAs($this->userWithPermission('wrong-permission'));

        $response->delete(route('admin.supervisor_users.destroy', $supervisor_user->id))
            ->assertForbidden();
    }
}
