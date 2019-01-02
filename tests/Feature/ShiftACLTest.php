<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShiftACLTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    function guests_can_not_visit_any_shifts_route()
    {
        $this->withExceptionHandling();
        $shift = create('App\Shift');

        $this->get(route('admin.shifts.index'))->assertRedirect('/admin/login');
        $this->get(route('admin.shifts.show', $shift->id))->assertRedirect('/admin/login');
        $this->get(route('admin.shifts.create'))->assertRedirect('/admin/login');
        $this->post(route('admin.shifts.store', $shift->toArray()))->assertRedirect('/admin/login');
        $this->get(route('admin.shifts.edit', $shift->id))->assertRedirect('/admin/login');
        $this->put(route('admin.shifts.update', $shift->id))->assertRedirect('/admin/login');
        $this->delete(route('admin.shifts.destroy', $shift->id))->assertRedirect('/admin/login');
    }

    /** @test */
    function it_requires_view_shifts_permissions_to_view_all_shifts()
    {
        $this->withExceptionHandling();
        // given
        $this->actingAs(create('App\User'));
        // $permission = create('App\Permission');

        // when
        $response = $this->get('/admin/shifts');

        // assert
        // $response->assertRedirect();
        $response->assertStatus(403);
    }

    /** @test */
    function it_requires_view_shifts_permissions_to_view_a_shift_details()
    {
        $this->withExceptionHandling();
        // given
        $shift = create('App\Shift');
        $this->actingAs(create('App\User'));

        // when
        $response = $this->get("/admin/shifts/{$shift->id}");

        // assert
        $response->assertStatus(403);
    }

    /** @test */
    function it_allows_users_to_view_shifts_if_they_have_view_shifts_permission()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('view-shifts');
        $shift = create('App\Shift');

        // when
        $this->actingAs($user);
        $response = $this->get('/admin/shifts');

        // assert
        $response->assertSee($shift->name);
    }

    /** @test */
    function it_allows_users_to_view_a_shift_if_they_have_view_shifts_permission()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('view-shifts');
        $shift = create('App\Shift');

        // when
        $this->actingAs($user);
        $response = $this->get(route('admin.shifts.show', $shift->id));

        // assert
        $response->assertSee($shift->name);
    }

    /** @test */
    function it_requires_create_shifts_permission_to_add_a_permission()
    {
        $this->withExceptionHandling();
        // Given
        $user = create('App\User');
        $this->actingAs($user);

        // When
        $response = $this->get(route('admin.shifts.create'));
        // Expect

        $response->assertStatus(403);
    }

    /** @test */
    function it_allows_with_create_shifts_permission_to_create_shifts()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('create-shifts');

        // when
        $this->actingAs($user);
        $response = $this->get(route('admin.shifts.create'));

        // assert
        $response->assertStatus(200);
    }

    /** @test */
    function it_requires_destroy_shifts_permission_to_destroy_a_permission()
    {
        $this->withExceptionHandling();
        // Given
        $this->actingAs(create('App\User'));
        $shift = create('App\Shift');

        // When
        $response = $this->delete(route('admin.shifts.destroy', $shift->id));

        // Expect

        $response->assertStatus(403);
    }

    /** @test */
    function it_allows_with_destroy_shifts_permission_to_destroy_shifts()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('destroy-shifts');
        $shift = create('App\Shift');

        // when
        $this->actingAs($user);
        $response = $this->delete(route('admin.shifts.destroy', $shift->id));

        // assert
        $response->assertRedirect(route('admin.shifts.index'));
        $this->assertDatabaseMissing('shifts', ['id' => $shift->id]);
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
