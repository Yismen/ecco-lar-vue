<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BankAccountTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    function guests_can_not_visit_any_bank_accounts_route()
    {
        $this->withExceptionHandling();
        $bank_account = create('App\BankAccount');
        $this->get(route('admin.bank_accounts.index'))->assertRedirect('/login');
        $this->get(route('admin.bank_accounts.show', $bank_account->slug))->assertRedirect('/login');
        $this->get(route('admin.bank_accounts.create'))->assertRedirect('/login');
        $this->post(route('admin.bank_accounts.store', $bank_account->toArray()))->assertRedirect('/login');
        $this->get(route('admin.bank_accounts.edit', $bank_account->slug))->assertRedirect('/login');
        $this->put(route('admin.bank_accounts.update', $bank_account->slug))->assertRedirect('/login');
        $this->delete(route('admin.bank_accounts.destroy', $bank_account->slug))->assertRedirect('/login');
    }


    /** @test */
    function it_requires_view_bank_accounts_permissions_to_view_all_bank_accounts()
    {
        $this->withExceptionHandling();
        $this->actingAs(create('App\User'));

        $response = $this->get('/admin/bank_accounts');

        $response->assertStatus(403);
    }

    /** @test */
    function it_requires_view_bank_accounts_permissions_to_view_a_bank_account_details()
    {
        $this->withExceptionHandling();
        // given
        $bank_account = create('App\BankAccount');
        $this->actingAs(create('App\User'));

        // when
        $response = $this->get("/admin/bank_accounts/{$bank_account->slug}");

        // assert
        $response->assertStatus(403);
    }

    /** @test */
    function it_allows_users_to_view_bank_accounts_if_they_have_view_bank_accounts_permission()
    {
        $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('view-bank-accounts');
        $bank_account = create('App\BankAccount');

        // when
        $this->actingAs($user);
        $response = $this->get('/admin/bank_accounts');

        // assert
        $response->assertSee($bank_account->name);
    }

    /** @test */
    function it_allows_users_to_view_a_bank_account_if_they_have_view_bank_accounts_permission()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('view-bank-accounts');
        $bank_account = create('App\BankAccount');

        // when
        $this->actingAs($user);
        $response = $this->get(route('admin.bank_accounts.show', $bank_account->slug));

        // assert
        $response->assertSee($bank_account->name);
    }

    /** @test */
    function it_requires_create_bank_accounts_permission_to_add_a_permission()
    {
        $this->withExceptionHandling();
        // Given
        $user = create('App\User');
        $this->actingAs($user);

        // When
        $response = $this->get(route('admin.bank_accounts.create'));
        // Expect

        $response->assertStatus(403);
    }

    /** @test */
    function it_allows_with_create_bank_accounts_permission_to_create_bank_accounts()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('create-bank-accounts');

        // when
        $this->actingAs($user);
        $response = $this->get(route('admin.bank_accounts.create'));

        // assert
        $response->assertStatus(200);
    }

    /** @test */
    function it_requires_destroy_bank_accounts_permission_to_destroy_a_permission()
    {
        $this->withExceptionHandling();
        // Given
        $this->actingAs(create('App\User'));
        $bank_account = create('App\BankAccount');

        // When
        $response = $this->delete(route('admin.bank_accounts.destroy', $bank_account->slug));

        // Expect

        $response->assertStatus(403);
    }

    /** @test */
    function it_allows_users_with_destroy_bank_accounts_permission_to_destroy_bank_accounts()
    {
        // $this->withExceptionHandling();
        // given
        $user = $this->userWithPermission('destroy-bank-accounts');
        $bank_account = create('App\BankAccount');

        // when
        $this->actingAs($user);
        $response = $this->delete(route('admin.bank_accounts.destroy', $bank_account->slug));

        // assert
        $response->assertRedirect(route('admin.bank_accounts.index'));
        $this->assertDatabaseMissing('bank_accounts', ['id' => $bank_account->slug]);
    }

    /** @test */
    function it_requires_a_name_to_create_a_bank_account()
    {
        $this->withExceptionHandling();

        $this->actingAs($this->userWithPermission('create-bank-accounts'))
            ->post(route('admin.bank_accounts.store'), $this->formAttributes(['name' => '']))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    function a_user_can_create_a_bank_account()
    {
        // $this->withExceptionHandling();
        $bank_account = make('App\BankAccount');

        $this->actingAs($this->userWithPermission('create-bank-accounts'))
            ->post(route('admin.bank_accounts.store', $bank_account->toArray()));

        $this->assertDatabaseHas('bank_accounts', ['name' => $bank_account->name]);

        $this->get(route('admin.bank_accounts.index'))
            ->assertSee($bank_account->name);

    }

    /** @test */
    function a_user_can_see_a_form_to_update_a_bank_account()
    {
        $this->withExceptionHandling();
        $bank_account = create('App\BankAccount');

        $this->actingAs($this->userWithPermission('edit-bank-accounts'))
            ->get(route('admin.bank_accounts.edit', $bank_account->slug))
            ->assertSee("Edit ARS " . $bank_account->name);

    }

    /** @test */
    function it_requires_a_name_to_update_a_bank_account()
    {
        $this->withExceptionHandling();
        $bank_account = create('App\BankAccount');

        $this->actingAs($this->userWithPermission('edit-bank-accounts'))
            ->put(route('admin.bank_accounts.update', $bank_account->slug), $this->formAttributes(['name' => '']))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    function a_user_can_update_a_bank_account()
    {
        $this->withExceptionHandling();
        $bank_account = create('App\BankAccount');
        $bank_account->name = 'New Name';

        $this->actingAs($this->userWithPermission('edit-bank-accounts'))
            ->put(route('admin.bank_accounts.update', $bank_account->slug), $bank_account->toArray());

        $this->assertDatabaseHas('bank_accounts', ['name' => 'New Name']);

        $this->get(route('admin.bank_accounts.index'))
            ->assertSee('New Name');

    }
}
