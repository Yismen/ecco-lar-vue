<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShiftTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    function a_user_can_create_a_shift()
    {
        // $this->withExceptionHandling();
        $shift = make('App\Shift', ['start' => '07:00', 'end' => '16:00']);

        $this->actingAs($this->userWithPermission('create-shifts'))
            ->post(route('admin.shifts.store', $shift->toArray()));

        $this->assertDatabaseHas('shifts', ['name' => $shift->name]);

        $this->get(route('admin.shifts.index'))
            ->assertSee($shift->name);

    }

    /** @test */
    function a_user_can_see_a_form_to_update_a_shift()
    {
        $this->withExceptionHandling();
        $shift = create('App\Shift', ['start' => '07:00', 'end' => '16:00']);

        $this->actingAs($this->userWithPermission('edit-shifts'))
            ->get(route('admin.shifts.edit', $shift->id))
            ->assertSee("Edit " . $shift->name);

    }

    /** @test */
    function a_user_can_update_a_shift()
    {
        $this->withExceptionHandling();
        $shift = create('App\Shift', ['start' => '07:00', 'end' => '16:00']);
        $shift->name = 'New Name';

        $this->actingAs($this->userWithPermission('edit-shifts'))
            ->put(route('admin.shifts.update', $shift->id), $shift->toArray());

        $this->assertDatabaseHas('shifts', ['name' => 'New Name']);

        $this->get(route('admin.shifts.index'))
            ->assertSee('New Name');

    }


    protected function userWithPermission($permit)
    {
        $user = create('App\User');
        $role = create('App\Role');
        $user->roles()->sync($role->id);
        $permission = create('App\Permission', ['name' => $permit]);
        $role->permissions()->sync($permission->id);

        return $user;
    }
}
