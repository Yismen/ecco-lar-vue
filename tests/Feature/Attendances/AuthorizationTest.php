<?php

namespace Tests\Feature\Attendances;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testUnuthorizedUsersCantViewAttendance()
    {
        $attendance = create('App\Attendance');
        $response = $this->actingAs($this->userWithPermission('wrong-permission'));

        $response->get(route('admin.attendances.index'))
            ->assertForbidden();

        $response->get(route('admin.attendances.show', $attendance->id))
            ->assertForbidden();
    }

    public function testUnuthorizedUsersCantCreatetAttendance()
    {
        $attendance = create('App\Attendance');
        $response = $this->actingAs($this->userWithPermission('wrong-permission'));

        $response->post(route('admin.attendances.store'))
            ->assertForbidden();
    }

    public function testUnuthorizedUsersCantEditAttendance()
    {
        $attendance = create('App\Attendance');
        $response = $this->actingAs($this->userWithPermission('wrong-permission'));

        $response->put(route('admin.attendances.update', $attendance->id))
            ->assertForbidden();
    }

    public function testUnuthorizedUsersCantDestroyAttendance()
    {
        $attendance = create('App\Attendance');
        $response = $this->actingAs($this->userWithPermission('wrong-permission'));

        $response->delete(route('admin.attendances.destroy', $attendance->id))
            ->assertForbidden();
    }
}
