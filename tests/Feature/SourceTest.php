<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SourceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    function a_user_can_create_a_source()
    {
        // $this->withExceptionHandling();
        $source = make('App\Source');

        $this->actingAs($this->userWithPermission('create-sources'))
            ->post(route('admin.sources.store', $source->toArray()));

        $this->assertDatabaseHas('sources', ['name' => $source->name]);

        $this->get(route('admin.sources.index'))
            ->assertSee($source->name);

    }

    /** @test */
    function a_user_can_see_a_form_to_update_a_source()
    {
        $this->withExceptionHandling();
        $source = create('App\Source', ['start' => '07:00', 'end' => '16:00']);

        $this->actingAs($this->userWithPermission('edit-sources'))
            ->get(route('admin.sources.edit', $source->id))
            ->assertSee("Edit " . $source->name);

    }

    /** @test */
    function a_user_can_update_a_source()
    {
        $this->withExceptionHandling();
        $source = create('App\Source', ['start' => '07:00', 'end' => '16:00']);
        $source->name = 'New Name';

        $this->actingAs($this->userWithPermission('edit-sources'))
            ->put(route('admin.sources.update', $source->id), $source->toArray());

        $this->assertDatabaseHas('sources', ['name' => 'New Name']);

        $this->get(route('admin.sources.index'))
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
