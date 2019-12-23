<?php

namespace Tests\Feature\Punches;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testUnuthorizedUsersCantViewPunch()
    {
        $this->withExceptionHandling();
        $punch = create('App\Punch');
        $response = $this->actingAs($this->userWithPermission('wrong-permission'));

        $response->get(route('admin.punches.index'))
            ->assertForbidden();

        $response->get(route('admin.punches.show', $punch->punch))
            ->assertForbidden();
    }

    public function testUnuthorizedUsersCantCreatetPunch()
    {
        $this->withExceptionHandling();
        $punch = create('App\Punch');
        $response = $this->actingAs($this->userWithPermission('wrong-permission'));

        $response->post(route('admin.punches.store'))
            ->assertForbidden();
    }

    public function testUnuthorizedUsersCantEditPunch()
    {
        $this->withExceptionHandling();
        $punch = create('App\Punch');
        $response = $this->actingAs($this->userWithPermission('wrong-permission'));

        $response->put(route('admin.punches.update', $punch->punch))
            ->assertForbidden();
    }

    public function testUnuthorizedUsersCantDestroyPunch()
    {
        $this->withExceptionHandling();
        $punch = create('App\Punch');
        $response = $this->actingAs($this->userWithPermission('wrong-permission'));

        $response->delete(route('admin.punches.destroy', $punch->punch))
            ->assertForbidden();
    }
}
