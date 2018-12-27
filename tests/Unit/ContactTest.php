<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Generator as Faker;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function unauthenticated_users_are_redirected()
    {
        $this->withExceptionHandling();

        $this->get('/admin/contacts')
            ->assertRedirect('admin/login');
    }

    /** @test */
    function authenticated_users_can_create_contacts()
    {
        $user = create('App\User');
        $contact = raw('App\Contact');

        $contact = $user->contacts()->create($contact);

        $this->actingAs($user)
            ->assertDatabaseHas('contacts', [
                'phone' => $contact->phone
            ]);

    }

}
