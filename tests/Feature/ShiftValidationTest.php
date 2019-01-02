<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShiftValidationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    function it_requires_a_name_to_create_a_shift()
    {
        $this->withExceptionHandling();

        $this->actingAs($this->userWithPermission('create-shifts'))
            ->post(route('admin.shifts.store'), $this->formAttributes(['name' => '']))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    function it_requires_a_unique_name_to_create_a_shift()
    {
        $this->withExceptionHandling();
        $shift = create('App\Shift');

        $this->actingAs($this->userWithPermission('create-shifts'))
            ->post(route('admin.shifts.store'), $shift->toArray())
            ->assertSessionHasErrors('name');
    }

    /** @test */
    function it_requires_a_start_to_create_a_shift()
    {
        $this->withExceptionHandling();

        $this->actingAs($this->userWithPermission('create-shifts'))
            ->post(route('admin.shifts.store'), $this->formAttributes(['start' => '']))
            ->assertSessionHasErrors('start');
    }

    /** @test */
    function it_requires_a_properly_formated_start_to_create_a_shift()
    {
        $this->withExceptionHandling();

        $this->actingAs($this->userWithPermission('create-shifts'))
            ->post(route('admin.shifts.store'), $this->formAttributes(['start' => 'not-a-time']))
            ->assertSessionHasErrors('start');
    }

    /** @test */
    function it_requires_a_end_to_create_a_shift()
    {
        $this->withExceptionHandling();

        $this->actingAs($this->userWithPermission('create-shifts'))
            ->post(route('admin.shifts.store'), $this->formAttributes(['end' => '']))
            ->assertSessionHasErrors('end');
    }

    /** @test */
    function it_requires_a_properly_formated_end_to_create_a_shift()
    {
        $this->withExceptionHandling();

        $this->actingAs($this->userWithPermission('create-shifts'))
            ->post(route('admin.shifts.store'), $this->formAttributes(['end' => 'not-a-time']))
            ->assertSessionHasErrors('end');
    }

    /** @test */
    function it_store_a_shift()
    {
        // $this->withExceptionHandling();
        $shift = make('App\Shift', ['start' => '07:00', 'end' => '16:00']);

        $this->actingAs($this->userWithPermission('create-shifts'))
            ->post(route('admin.shifts.store', $shift->toArray()));

        $this->assertDatabaseHas('shifts', ['name' => $shift->name]);

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

    protected function formAttributes($array = [])
    {
        return array_merge([
            'name' => $this->faker->name,
            'start' => $this->faker->time,
            'end' => $this->faker->time,
        ], $array);
    }
}
