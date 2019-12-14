<?php

namespace Tests\Feature\Supervisors;

use App\Supervisor;
use App\SupervisorUser;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormValidationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function supervisor_id_is_required_to_create_a_supervisor_user()
    {
        $user = create(User::class);
        $supervisor = create(Supervisor::class);
        $user->supervisors()->sync((array) $supervisor->id);
        $supervisor_user = SupervisorUser::where('user_id', $user->id)
            ->where('supervisor_id', $supervisor->id)
            ->first()->toArray();
        
        $this->actingAs($this->userWithPermission('create-supervisor-users'))
            ->post(route('admin.supervisor_users.store'), array_merge($supervisor_user, ['supervisor_id' => '']))
            ->assertSessionHasErrors('supervisor_id');

        $this->actingAs($this->userWithPermission('edit-supervisor-users'))
            ->put(route('admin.supervisor_users.update', $supervisor_user['id']), array_merge($supervisor_user, ['supervisor_id' => '']))
            ->assertSessionHasErrors('supervisor_id');
    }

    /** @test */
    public function supervisor_id_must_exists_in_the_supervisors_table()
    {
        $user = create(User::class);
        $supervisor = create(Supervisor::class);
        $user->supervisors()->sync((array) $supervisor->id);
        $supervisor_user = SupervisorUser::where('user_id', $user->id)
            ->where('supervisor_id', $supervisor->id)
            ->first()->toArray();
        
        $this->actingAs($this->userWithPermission('create-supervisor-users'))
            ->post(route('admin.supervisor_users.store'),  ['supervisor_id' => 120])
            ->assertSessionHasErrors('supervisor_id');

        $this->actingAs($this->userWithPermission('edit-supervisor-users'))
            ->put(route('admin.supervisor_users.update', $supervisor_user['id']), array_merge($supervisor_user, ['supervisor_id' => 120]))
            ->assertSessionHasErrors('supervisor_id');
    }

    /** @test */
    public function user_id_is_required_to_create_a_supervisor_user()
    {
        $user = create(User::class);
        $supervisor = create(Supervisor::class);
        $user->supervisors()->sync((array) $supervisor->id);
        $supervisor_user = SupervisorUser::where('user_id', $user->id)
            ->where('supervisor_id', $supervisor->id)
            ->first()->toArray();
        
        $this->actingAs($this->userWithPermission('create-supervisor-users'))
            ->post(route('admin.supervisor_users.store'), array_merge($supervisor_user, ['user_id' => '']))
            ->assertSessionHasErrors('user_id');

        $this->actingAs($this->userWithPermission('edit-supervisor-users'))
            ->put(route('admin.supervisor_users.update', $supervisor_user['id']), array_merge($supervisor_user, ['user_id' => '']))
            ->assertSessionHasErrors('user_id');
    }

    /** @test */
    public function user_id_must_exists_in_the_users_table()
    {
        $user = create(User::class);
        $supervisor = create(Supervisor::class);
        $user->supervisors()->sync((array) $supervisor->id);
        $supervisor_user = SupervisorUser::where('user_id', $user->id)
            ->where('supervisor_id', $supervisor->id)
            ->first()->toArray();
        
        $this->actingAs($this->userWithPermission('create-supervisor-users'))
            ->post(route('admin.supervisor_users.store'),  ['user_id' => 120])
            ->assertSessionHasErrors('user_id');

        $this->actingAs($this->userWithPermission('edit-supervisor-users'))
            ->put(route('admin.supervisor_users.update', $supervisor_user['id']), array_merge($supervisor_user, ['user_id' => 120]))
            ->assertSessionHasErrors('user_id');
    }
}
