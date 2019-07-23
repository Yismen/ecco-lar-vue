<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BankTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function guests_can_not_visit_any_banks_route()
    {
        $this->withExceptionHandling();
        $bank = create('App\Bank');
        $this->get(route('admin.banks.index'))->assertRedirect('/login');
        // $this->get(route('admin.banks.create'))->assertRedirect('/login');
        $this->post(route('admin.banks.store', $bank->toArray()))->assertRedirect('/login');
        $this->get(route('admin.banks.edit', $bank->id))->assertRedirect('/login');
        $this->put(route('admin.banks.update', $bank->id))->assertRedirect('/login');
        $this->delete(route('admin.banks.destroy', $bank->id))->assertRedirect('/login');
    }

    /** @test */
    public function it_requires_view_banks_permissions_to_view_all_banks()
    {
        $this->withExceptionHandling();
        $this->actingAs(create('App\User'));

        $response = $this->get('/admin/banks');

        $response->assertStatus(403);
    }

    /** @test */
    public function it_allows_users_to_view_banks_if_they_have_view_banks_permission()
    {
        $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('view-banks');
        $bank = create('App\Bank');

        // when
        $this->actingAs($user);
        $response = $this->get('/admin/banks');

        // assert
        $response->assertSee($bank->name);
    }

    /** @test */
    public function it_requires_destroy_banks_permission_to_destroy_a_permission()
    {
        $this->withExceptionHandling();
        // Given
        $this->actingAs(create('App\User'));
        $bank = create('App\Bank');

        // When
        $response = $this->delete(route('admin.banks.destroy', $bank->id));

        // Expect

        $response->assertStatus(403);
    }

    /** @test */
    public function it_allows_users_with_destroy_banks_permission_to_destroy_banks()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('destroy-banks');
        $bank = create('App\Bank');

        // when
        $this->actingAs($user);
        $response = $this->delete(route('admin.banks.destroy', $bank->id));

        // assert
        $response->assertRedirect(route('admin.banks.index'));
        $this->assertDatabaseMissing('banks', ['id' => $bank->id]);
    }

    /** @test */
    public function it_requires_a_name_to_create_a_bank()
    {
        $this->withExceptionHandling();

        $this->actingAs($this->userWithPermission('create-banks'))
            ->post(route('admin.banks.store'), $this->formAttributes(['name' => '']))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_user_can_create_a_bank()
    {
        // $this->withExceptionHandling();
        $bank = make('App\Bank');

        $this->actingAs($this->userWithPermission('create-banks'))
            ->post(route('admin.banks.store', $bank->toArray()));

        $this->assertDatabaseHas('banks', ['name' => $bank->name]);

        $this->actingAs($this->userWithPermission('view-banks'))
            ->get(route('admin.banks.index'))
            ->assertSee($bank->name);
    }

    /** @test */
    public function a_user_can_see_a_form_to_update_a_bank()
    {
        $this->withExceptionHandling();
        $bank = create('App\Bank');

        $this->actingAs($this->userWithPermission('edit-banks'))
            ->get(route('admin.banks.edit', $bank->id))
            ->assertSee('Edit Bank '.$bank->name);
    }

    /** @test */
    public function it_requires_a_name_to_update_a_bank()
    {
        $this->withExceptionHandling();
        $bank = create('App\Bank');

        $this->actingAs($this->userWithPermission('edit-banks'))
            ->put(route('admin.banks.update', $bank->id), $this->formAttributes(['name' => '']))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_user_can_update_a_bank()
    {
        $this->withExceptionHandling();
        $bank = create('App\Bank');
        $bank->name = 'New Name';

        $this->actingAs($this->userWithPermission('edit-banks'))
            ->put(route('admin.banks.update', $bank->id), $bank->toArray());

        $this->assertDatabaseHas('banks', ['name' => 'New Name']);

        $this->get(route('admin.banks.index'))
            ->assertSee('New Name');
    }
}
