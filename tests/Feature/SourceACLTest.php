<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SourceACLTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    function guests_can_not_visit_any_sources_route()
    {
        $this->withExceptionHandling();
        $source = create('App\Source');

        $this->get(route('admin.sources.index'))->assertRedirect('/admin/login');
        $this->get(route('admin.sources.show', $source->id))->assertRedirect('/admin/login');
        $this->get(route('admin.sources.create'))->assertRedirect('/admin/login');
        $this->post(route('admin.sources.store', $source->toArray()))->assertRedirect('/admin/login');
        $this->get(route('admin.sources.edit', $source->id))->assertRedirect('/admin/login');
        $this->put(route('admin.sources.update', $source->id))->assertRedirect('/admin/login');
        $this->delete(route('admin.sources.destroy', $source->id))->assertRedirect('/admin/login');
    }

    /** @test */
    function it_requires_view_sources_permissions_to_view_all_sources()
    {
        $this->withExceptionHandling();
        $this->actingAs(create('App\User'));

        $response = $this->get('/admin/sources');

        $response->assertStatus(403);
    }

    /** @test */
    function it_requires_view_sources_permissions_to_view_a_source_details()
    {
        $this->withExceptionHandling();
        // given
        $source = create('App\Source');
        $this->actingAs(create('App\User'));

        // when
        $response = $this->get("/admin/sources/{$source->id}");

        // assert
        $response->assertStatus(403);
    }

    /** @test */
    function it_allows_users_to_view_sources_if_they_have_view_sources_permission()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('view-sources');
        $source = create('App\Source');

        // when
        $this->actingAs($user);
        $response = $this->get('/admin/sources');

        // assert
        $response->assertSee($source->name);
    }

    /** @test */
    function it_allows_users_to_view_a_source_if_they_have_view_sources_permission()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('view-sources');
        $source = create('App\Source');

        // when
        $this->actingAs($user);
        $response = $this->get(route('admin.sources.show', $source->id));

        // assert
        $response->assertSee($source->name);
    }

    /** @test */
    function it_requires_create_sources_permission_to_add_a_permission()
    {
        $this->withExceptionHandling();
        // Given
        $user = create('App\User');
        $this->actingAs($user);

        // When
        $response = $this->get(route('admin.sources.create'));
        // Expect

        $response->assertStatus(403);
    }

    /** @test */
    function it_allows_with_create_sources_permission_to_create_sources()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('create-sources');

        // when
        $this->actingAs($user);
        $response = $this->get(route('admin.sources.create'));

        // assert
        $response->assertStatus(200);
    }

    /** @test */
    function it_requires_destroy_sources_permission_to_destroy_a_permission()
    {
        $this->withExceptionHandling();
        // Given
        $this->actingAs(create('App\User'));
        $source = create('App\Source');

        // When
        $response = $this->delete(route('admin.sources.destroy', $source->id));

        // Expect

        $response->assertStatus(403);
    }

    /** @test */
    function it_allows_users_with_destroy_sources_permission_to_destroy_sources()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('destroy-sources');
        $source = create('App\Source');

        // when
        $this->actingAs($user);
        $response = $this->delete(route('admin.sources.destroy', $source->id));

        // assert
        $response->assertRedirect(route('admin.sources.index'));
        $this->assertDatabaseMissing('sources', ['id' => $source->id]);
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
