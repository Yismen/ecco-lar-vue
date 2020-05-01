<?php

namespace Tests\Feature\SupervisorUsers;

use App\Supervisor;
use App\SupervisorUser;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleActionsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function authorized_users_can_see_supervisor_user_list()
    {
        $this->actingAs($this->userWithPermission('view-supervisor-users'))
            ->get(route('admin.supervisor_users.index'))
            ->assertOk()
            ->assertViewIs('supervisor_users.index');
    }

    /** @test */
    public function it_lists_all_users_assigned_with_supervisor()
    {
        $users = create(User::class, [], 3);
        $supervisor = create(Supervisor::class)->toArray();
        $supervisors[] =  $supervisor['id'];

        $users->first()->supervisors()->sync((array) $supervisors);

        $this->actingAs($this->userWithPermission('view-supervisor-users'))
            ->get(route('admin.supervisor_users.index'))
            ->assertSee($users->first()->name)
            ->assertSee($supervisor['name']);
    }

    /** @test */
    public function it_lists_all_users_without_supervisors()
    {
        $users = create(User::class, [], 2);

        $this->actingAs($this->userWithPermission('view-supervisor-users'))
            ->get(route('admin.supervisor_users.index'))
            ->assertSee(e($users->first()->name))
            ->assertSee(e($users->last()->name));
    }

    /** @test */
    public function it_lists_all_supervisors_without_users()
    {
        $this->withoutExceptionHandling();
        $supervisors = create(Supervisor::class, [], 2);

        $this->actingAs($this->userWithPermission('view-supervisor-users'))
            ->get(route('admin.supervisor_users.index'))
            ->assertSee($supervisors->first()->name)
            // ->assertSee($supervisors->last()->name)
            ->assertSee('Relate Users to Supervisors')
            ->assertViewHasAll(['assigned', 'free_users', 'free_supervisors']);
    }

    /** @test */
    public function authorized_users_can_store_supervisor_user_relationships()
    {
        $user = create(User::class);
        $supervisor = create(Supervisor::class);
        $data_array = [
            'supervisor_id' => $supervisor->id,
            'user_id' => $user->id,
        ];

        $this->actingAs($this->userWithPermission('create-supervisor-users'))
            ->post(route('admin.supervisor_users.store', $data_array))
            ->assertRedirect()
            ->assertLocation('admin/supervisor_users');

        $this->assertDatabaseHas('supervisor_user', $data_array);
    }

    /** @test */
    public function authorized_users_can_see_edit_page()
    {
        $user = create(User::class);
        $supervisor = create(Supervisor::class);
        $user->supervisors()->sync((array) $supervisor->id);

        $supervisor_user = SupervisorUser::first();

        $this->actingAs($this->userWithPermission('edit-supervisor-users'))
            ->get(route('admin.supervisor_users.edit', $supervisor_user->id))
            ->assertOk()
            ->assertViewIs('supervisor_users.edit')
            ->assertViewHasAll(['free_users', 'free_supervisors'])
            ->assertSee('Edit Supervisor User Relationship')
            ->assertSee('User:')
            ->assertSee('Supervisor:')
            ->assertSee('UPDATE');
    }

    /** @test */
    public function authorized_users_can_update_supervisor_user_relationships()
    {
        $user = create(User::class);
        $supervisor = create(Supervisor::class);
        $user->supervisors()->sync((array) $supervisor->id);

        $new_user = create(User::class);
        $new_supervisor = create(Supervisor::class);

        $supervisor_user = SupervisorUser::where('user_id', $user->id)->where('supervisor_id', $supervisor->id)->first();

        $data_array = [
            'user_id' => $new_user->id,
            'supervisor_id' => $new_supervisor->id,
        ];

        $this->actingAs($this->userWithPermission('edit-supervisor-users'))
            ->put(route('admin.supervisor_users.update', $supervisor_user->id), $data_array)
            ->assertRedirect()
            ->assertLocation('admin/supervisor_users');

        $this->assertDatabaseHas('supervisor_user', $data_array);
    }

    /** @test */
    public function authorized_users_can_destroy_supervisor_user_relationships()
    {
        $user = create(User::class);
        $supervisor = create(Supervisor::class);
        $user->supervisors()->sync((array) $supervisor->id);

        $supervisor_user = SupervisorUser::where('user_id', $user->id)->where('supervisor_id', $supervisor->id)->first();

        $data_array = [
            'user_id' => $user->id,
            'supervisor_id' => $supervisor->id,
        ];

        $this->withoutExceptionHandling();

        $this->actingAs($this->userWithPermission('destroy-supervisor-users'))
            ->delete(route('admin.supervisor_users.destroy', $supervisor_user->id))
            ->assertRedirect()
            ->assertLocation('admin/supervisor_users');

        $this->assertDatabaseMissing('supervisor_user', $data_array);
    }
}
