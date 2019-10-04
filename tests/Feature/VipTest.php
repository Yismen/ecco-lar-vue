<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VipTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** test */
    public function it_requries_authentication()
    {
        $this->withExceptionHandling();
        $vip = create('App\Vip');
        $this->get(route('admin.vips.index'))->assertRedirect('/login');
        $this->get(route('admin.vips.show', $vip->id))->assertRedirect('/login');
        $this->get(route('admin.vips.create'))->assertRedirect('/login');
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

        $response = $this->get("/admin/vips/{$vip->id}");
        $response->assertStatus(403);

        $response = $this->get(route('admin.vips.create'));
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

    public function testAuthenticatedUsersWithViewVipsPermissionCanViewVips()
    {
        $this->withExceptionHandling();
        $user = $this->userWithPermission('view-vips');
        $vip = create('App\Vip');
        $this->actingAs($user);

        $response = $this->get('/admin/vips');
        $response->assertSee($vip->name);

        $response = $this->get(route('admin.vips.show', $vip->id));
        $response->assertSee($vip->name);
    }

    /** @test */
    public function it_allows_users_with_create_vips_permission_to_create_vips()
    {
        $this->withExceptionHandling();
        $user = $this->userWithPermission('create-vips');
        $this->actingAs($user);

        $response = $this->get(route('admin.vips.create'));
        $response->assertStatus(200);
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

        $this->assertDatabaseHas('vips', ['name' => $vip->name]);

        $this->get(route('admin.vips.index'))
            ->assertSee($vip->name);
    }

    /** @test */
    public function it_requires_a_name_to_create_a_vip()
    {
        $this->withExceptionHandling();

        $this->actingAs($this->userWithPermission('create-vips'))
            ->post(route('admin.vips.store'), $this->formAttributes(['name' => '']))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_user_can_see_a_form_to_update_a_vip()
    {
        $this->withExceptionHandling();
        $vip = create('App\Vip');

        $this->actingAs($this->userWithPermission('edit-vips'))
            ->get(route('admin.vips.edit', $vip->id))
            ->assertSee('Edit AFP '.$vip->name);
    }

    /** @test */
    public function it_requires_a_name_to_update_a_vip()
    {
        $this->withExceptionHandling();
        $vip = create('App\Vip');

        $this->actingAs($this->userWithPermission('edit-vips'))
            ->put(route('admin.vips.update', $vip->id), $this->formAttributes(['name' => '']))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_user_can_update_a_vip()
    {
        $this->withExceptionHandling();
        $vip = create('App\Vip');
        $vip->name = 'New Name';

        $this->actingAs($this->userWithPermission('edit-vips'))
            ->put(route('admin.vips.update', $vip->id), $vip->toArray());

        $this->assertDatabaseHas('vips', ['name' => 'New Name']);

        $this->get(route('admin.vips.index'))
            ->assertSee('New Name');
    }
}
