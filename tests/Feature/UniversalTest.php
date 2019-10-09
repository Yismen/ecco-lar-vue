<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UniversalTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_requries_authentication()
    {
        $this->withExceptionHandling();
        $universal = create('App\Universal');
        $this->get(route('admin.universals.index'))->assertRedirect('/login');
        $this->post(route('admin.universals.store', $universal->toArray()))->assertRedirect('/login');
        $this->get(route('admin.universals.edit', $universal->id))->assertRedirect('/login');
        $this->put(route('admin.universals.update', $universal->id))->assertRedirect('/login');
        $this->delete(route('admin.universals.destroy', $universal->id))->assertRedirect('/login');
    }

    /** @test */
    public function it_requires_permissions()
    {
        $this->withExceptionHandling();
        $this->actingAs(create('App\User'));
        $universal = create('App\Universal');

        $response = $this->get('/admin/universals');
        $response->assertStatus(403);

        $response = $this->post(route('admin.universals.store'));
        $response->assertStatus(403);

        $response = $this->get(route('admin.universals.edit', $universal->id));
        $response->assertStatus(403);

        $response = $this->put(route('admin.universals.update', $universal->id));
        $response->assertStatus(403);

        $response = $this->delete(route('admin.universals.destroy', $universal->id));
        $response->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_view_universal_resource()
    {
        $this->withExceptionHandling();
        $user = $this->userWithPermission('view-universals');
        $universal = create('App\Universal');
        $this->actingAs($user);

        $employee = create('App\Employee');
        $universal->employee()->associate($employee);
        $universal->save();

        $response = $this->get('/admin/universals');
        $response->assertSee(e('Universal List'));
        $response->assertSee(e('Add to Universals List'));
        $response->assertSee(e($universal->employee->full_name));
    }

    /** @test */
    public function authorized_users_can_create_universal_resource()
    {
        // $this->withExceptionHandling();
        $user = $this->userWithPermission('create-universals');
        $this->actingAs($user);

        $universal = create('App\Universal');

        $employee = create('App\Employee');
        $universal->employee()->associate($employee);
        $universal->save();

        $response = $this->post(
            route(
                'admin.universals.store', $this->formAttributes(
                    ['employee_id' => $employee->id, 'since' => Carbon::now()->format('Y-m-d')]
                )
            )
        );

        $response->assertRedirect(route('admin.universals.index'));
    }

    /** @test */
    public function it_allows_users_with_destroy_universals_permission_to_destroy_universals()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('destroy-universals');
        $universal = create('App\Universal');

        // when
        $this->actingAs($user);
        $response = $this->delete(route('admin.universals.destroy', $universal->id));

        // assert
        $response->assertRedirect(route('admin.universals.index'));
        $this->assertDatabaseMissing('universals', ['id' => $universal->id]);
    }

    /** @test */
    public function a_user_can_create_a_universal()
    {
        // $this->withExceptionHandling();
        $universal = create('App\Universal');

        $employee = create('App\Employee');
        $universal->employee()->associate($employee);
        $universal->save();

        $this->actingAs($this->userWithPermission('create-universals'))
            ->post(route('admin.universals.store', $universal->toArray()));

        $this->assertDatabaseHas('universals', ['employee_id' => $universal->employee_id]);

        $this->get(route('admin.universals.index'))
            ->assertSee(e($universal->employee->full_name));
    }

    /** @test */
    public function it_requires_a_date_to_create_a_universal()
    {
        $this->withExceptionHandling();

        $this->actingAs($this->userWithPermission('create-universals'))
            ->post(route('admin.universals.store'), $this->formAttributes(['since' => '']))
            ->assertSessionHasErrors('since');
    }

    /** @test */
    public function a_user_can_see_a_form_to_update_a_universal()
    {
        $this->withExceptionHandling();
        $universal = create('App\Universal');

        $employee = create('App\Employee');
        $universal->employee()->associate($employee);
        $universal->save();

        $this->actingAs($this->userWithPermission('edit-universals'))
            ->get(route('admin.universals.edit', $universal->id))
            ->assertSee(e('Edit Universal '.$universal->employee->full_name));
    }

    /** @test */
    public function test_validations_to_update()
    {
        $this->withExceptionHandling();
        $user = $this->userWithPermission('edit-universals');
        $universal = create('App\Universal');

        $this->actingAs($user)
            ->put(route('admin.universals.update', $universal->id), $this->formAttributes(['since' => '']))
            ->assertSessionHasErrors('since');
    }

    /** @test */
    public function a_user_can_update_a_universal()
    {
        $this->withExceptionHandling();
        $universal = create('App\Universal');
        $date = Carbon::now();
        $universal->since = $date;

        $this->actingAs($this->userWithPermission('edit-universals'))
            ->put(route('admin.universals.update', $universal->id), $universal->toArray());

        $this->assertDatabaseHas('universals', ['since' => $date]);

        $this->get(route('admin.universals.index'))
            ->assertSee(e($date->diffForHumans()));
    }
}
