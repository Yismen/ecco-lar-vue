<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VipTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_requries_authentication()
    {
        $this->withExceptionHandling();
        $vip = create('App\Vip');
        $this->get(route('admin.vips.index'))->assertRedirect('/login');
        $this->post(route('admin.vips.store', $vip->toArray()))->assertRedirect('/login');
        $this->get(route('admin.vips.edit', $vip->id))->assertRedirect('/login');
        $this->put(route('admin.vips.update', $vip->id))->assertRedirect('/login');
        $this->delete(route('admin.vips.destroy', $vip->id))->assertRedirect('/login');
    }

    /** @test */
    public function it_requires_permissions()
    {
        $this->withExceptionHandling();
        $this->actingAs(create('App\User'));
        $vip = create('App\Vip');

        $response = $this->get('/admin/vips');
        $response->assertStatus(403);

        $response = $this->post(route('admin.vips.store'));
        $response->assertStatus(403);

        $response = $this->get(route('admin.vips.edit', $vip->id));
        $response->assertStatus(403);

        $response = $this->put(route('admin.vips.update', $vip->id));
        $response->assertStatus(403);

        $response = $this->delete(route('admin.vips.destroy', $vip->id));
        $response->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_view_vip_resource()
    {
        $this->withExceptionHandling();
        $user = $this->userWithPermission('view-vips');
        $vip = create('App\Vip');
        $employee = create('App\Employee');
        $this->actingAs($user);

        $vip->employee()->associate($employee);
        $vip->save();

        $response = $this->get('/admin/vips');
        $response->assertSee('VIP List');
        $response->assertSee('Add to VIP List');
        $response->assertSee($vip->employee->full_name);
    }

    /** @test */
    public function authorized_users_can_create_vip_resource()
    {
        // $this->withExceptionHandling();
        $user = $this->userWithPermission('create-vips');
        $this->actingAs($user);

        $vip = create('App\Vip');
        $employee = create('App\Employee');

        $response = $this->post(
            route(
                'admin.vips.store',
                $this->formAttributes(
                    ['employee_id' => $employee->id, 'since' => Carbon::now()->format('Y-m-d')]
                )
            )
        );

        $response->assertRedirect(route('admin.vips.index'));
        // $response->assertSee($vip->employee->full_name);
    }

    /** @test */
    public function it_allows_users_with_destroy_vips_permission_to_destroy_vips()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('destroy-vips');
        $vip = create('App\Vip');

        // when
        $this->actingAs($user);
        $response = $this->delete(route('admin.vips.destroy', $vip->id));

        // assert
        $response->assertRedirect(route('admin.vips.index'));
        $this->assertDatabaseMissing('vips', ['id' => $vip->id]);
    }

    /** @test */
    public function a_user_can_create_a_vip()
    {
        // $this->withExceptionHandling();
        $vip = make('App\Vip');

        $this->actingAs($this->userWithPermission('create-vips'))
            ->post(route('admin.vips.store', $vip->toArray()));

        $this->assertDatabaseHas('vips', ['employee_id' => $vip->employee_id]);

        $this->get(route('admin.vips.index'))
            ->assertSee($vip->employee->full_name);
    }

    /** @test */
    public function it_requires_a_date_to_create_a_vip()
    {
        $this->withExceptionHandling();

        $this->actingAs($this->userWithPermission('create-vips'))
            ->post(route('admin.vips.store'), $this->formAttributes(['since' => '']))
            ->assertSessionHasErrors('since');
    }

    /** @test */
    public function a_user_can_see_a_form_to_update_a_vip()
    {
        $this->withExceptionHandling();
        $vip = create('App\Vip');

        $this->actingAs($this->userWithPermission('edit-vips'))
            ->get(route('admin.vips.edit', $vip->id))
            ->assertSee('Edit VIP ' . $vip->employee->full_name);
    }

    /** @test */
    public function test_validations_to_update()
    {
        $this->withExceptionHandling();
        $user = $this->userWithPermission('edit-vips');
        $vip = create('App\Vip');

        $this->actingAs($user)
            ->put(route('admin.vips.update', $vip->id), $this->formAttributes(['since' => '']))
            ->assertSessionHasErrors('since');
    }

    /** @test */
    public function a_user_can_update_a_vip()
    {
        $this->withExceptionHandling();
        $vip = create('App\Vip');
        $date = Carbon::now()->format('Y-m-d 00:00:00');
        $array = ['since' => $date];

        $this->actingAs($this->userWithPermission('edit-vips'))
            ->put(route('admin.vips.update', $vip->id), $array);

        $this->assertDatabaseHas('vips', $array);

        $this->get(route('admin.vips.index'))
            ->assertSee(Carbon::parse($date)->diffForHumans());
    }
}
