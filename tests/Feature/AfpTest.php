<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AfpTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function guests_can_not_visit_any_afps_route()
    {
        $this->withExceptionHandling();
        $afp = create('App\Afp');
        $this->get(route('admin.afps.index'))->assertRedirect('/login');
        $this->get(route('admin.afps.show', $afp->id))->assertRedirect('/login');
        $this->get(route('admin.afps.create'))->assertRedirect('/login');
        $this->post(route('admin.afps.store', $afp->toArray()))->assertRedirect('/login');
        $this->get(route('admin.afps.edit', $afp->id))->assertRedirect('/login');
        $this->put(route('admin.afps.update', $afp->id))->assertRedirect('/login');
        $this->delete(route('admin.afps.destroy', $afp->id))->assertRedirect('/login');
    }

    /** @test */
    public function it_requires_view_afps_permissions_to_view_all_afps()
    {
        $this->withExceptionHandling();
        $this->actingAs(create('App\User'));

        $response = $this->get('/admin/afps');

        $response->assertStatus(403);
    }

    /** @test */
    public function it_requires_view_afps_permissions_to_view_a_afp_details()
    {
        $this->withExceptionHandling();
        // given
        $afp = create('App\Afp');
        $this->actingAs(create('App\User'));

        // when
        $response = $this->get("/admin/afps/{$afp->id}");

        // assert
        $response->assertStatus(403);
    }

    /** @test */
    public function it_allows_users_to_view_afps_if_they_have_view_afps_permission()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('view-afps');
        $afp = create('App\Afp');

        // when
        $this->actingAs($user);
        $response = $this->get('/admin/afps');

        // assert
        $response->assertSee(e($afp->name));
    }

    /** @test */
    public function it_allows_users_to_view_a_afp_if_they_have_view_afps_permission()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('view-afps');
        $afp = create('App\Afp');

        // when
        $this->actingAs($user);
        $response = $this->get(route('admin.afps.show', $afp->id));

        // assert
        $response->assertSee(e($afp->name));
    }

    /** @test */
    public function it_requires_create_afps_permission_to_add_a_permission()
    {
        $this->withExceptionHandling();
        // Given
        $user = create('App\User');
        $this->actingAs($user);

        // When
        $response = $this->get(route('admin.afps.create'));
        // Expect

        $response->assertStatus(403);
    }

    /** @test */
    public function it_allows_with_create_afps_permission_to_create_afps()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('create-afps');

        // when
        $this->actingAs($user);
        $response = $this->get(route('admin.afps.create'));

        // assert
        $response->assertStatus(200);
    }

    /** @test */
    public function it_requires_destroy_afps_permission_to_destroy_a_permission()
    {
        $this->withExceptionHandling();
        // Given
        $this->actingAs(create('App\User'));
        $afp = create('App\Afp');

        // When
        $response = $this->delete(route('admin.afps.destroy', $afp->id));

        // Expect

        $response->assertStatus(403);
    }

    /** @test */
    public function it_allows_users_with_destroy_afps_permission_to_destroy_afps()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('destroy-afps');
        $afp = create('App\Afp');

        // when
        $this->actingAs($user);
        $response = $this->delete(route('admin.afps.destroy', $afp->id));

        // assert
        $response->assertRedirect(route('admin.afps.index'));
        $this->assertDatabaseMissing('afps', ['id' => $afp->id]);
    }

    /** @test */
    public function it_requires_a_name_to_create_a_afp()
    {
        $this->withExceptionHandling();

        $this->actingAs($this->userWithPermission('create-afps'))
            ->post(route('admin.afps.store'), $this->formAttributes(['name' => '']))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_user_can_create_a_afp()
    {
        // $this->withExceptionHandling();
        $afp = make('App\Afp');

        $this->actingAs($this->userWithPermission('create-afps'))
            ->post(route('admin.afps.store', $afp->toArray()));

        $this->assertDatabaseHas('afps', ['name' => $afp->name]);

        $this->get(route('admin.afps.index'))
            ->assertSee(e($afp->name));
    }

    /** @test */
    public function a_user_can_see_a_form_to_update_a_afp()
    {
        $this->withExceptionHandling();
        $afp = create('App\Afp');

        $this->actingAs($this->userWithPermission('edit-afps'))
            ->get(route('admin.afps.edit', $afp->id))
            ->assertSee(e('Edit AFP '.$afp->name));
    }

    /** @test */
    public function it_requires_a_name_to_update_a_afp()
    {
        $this->withExceptionHandling();
        $afp = create('App\Afp');

        $this->actingAs($this->userWithPermission('edit-afps'))
            ->put(route('admin.afps.update', $afp->id), $this->formAttributes(['name' => '']))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_user_can_update_a_afp()
    {
        $this->withExceptionHandling();
        $afp = create('App\Afp');
        $afp->name = 'New Name';

        $this->actingAs($this->userWithPermission('edit-afps'))
            ->put(route('admin.afps.update', $afp->id), $afp->toArray());

        $this->assertDatabaseHas('afps', ['name' => 'New Name']);

        $this->get(route('admin.afps.index'))
            ->assertSee(e('New Name'));
    }
}
