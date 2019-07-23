<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthenticated_users_are_redirected()
    {
        $this->withExceptionHandling();

        $this->get('/admin/contacts')
            ->assertRedirect('login');
    }

    /** @test */
    public function authenticated_users_can_create_contacts()
    {
        $user = create('App\User');
        $contact = raw('App\Contact');

        $contact = $user->contacts()->create($contact);

        $this->actingAs($user)
            ->assertDatabaseHas('contacts', [
                'phone' => $contact->phone,
            ]);
    }
}
