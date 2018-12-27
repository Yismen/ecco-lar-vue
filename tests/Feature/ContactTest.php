<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function users_can_see_their_contacts()
    {
        $user = create('App\User');
        $contact = $user->contacts()->create(
            factory('App\Contact')->raw()
        );

        $this->actingAs($user);

        $this->get(route('admin.contacts.index'))
            ->assertSee($contact->name);
    }

    /** @test */
    function users_cant_see_contacts_created_by_another_user()
    {
        $user = create('App\User');
        $contact = $user->contacts()->create(
            factory('App\Contact')->raw()
        );

        $this->actingAs(create('App\User'));

        $this->get(route('admin.contacts.index'))
            ->assertDontSee($contact->name);
    }

    /** @test */
    function a_user_can_see_details_of_an_owned_contact()
    {
        $user = create('App\User');
        $contact = $user->contacts()->create(
            factory('App\Contact')->raw()
        );

        $this->actingAs($user);

        $this->get(route('admin.contacts.show', $contact->id))
            ->assertSee($contact->name);
    }

    /** @test */
    function users_cant_see_details_of_not_owned_contacts()
    {
        $this->withExceptionHandling();

        $user = create('App\User');
        $contact = $user->contacts()->create(
            factory('App\Contact')->raw()
        );

        $this->actingAs(create('App\User'));

        $this->get(route('admin.contacts.show', $contact->id))
            ->assertStatus(404);
    }
}
