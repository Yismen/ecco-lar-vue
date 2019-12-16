<?php

namespace Tests\Feature\AttendanceCodes;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testGuestCantViewAttendanceCodes()
    {
        $attendance_code = create('App\AttendanceCode');
        $this->withExceptionHandling();
        
        $this->get(route('admin.attendance_codes.index'))->assertRedirect('/login');
    }

    public function testGuestCantEditAttendanceCodes()
    {
        $attendance_code = create('App\AttendanceCode');
        $this->withExceptionHandling();

        $this->put(route('admin.attendance_codes.update', $attendance_code->id))->assertRedirect('/login');
    }

    public function testGuestCantDestroyAttendanceCode()
    {
        $attendance_code = create('App\AttendanceCode');
        $this->withExceptionHandling();

        $this->delete(route('admin.attendance_codes.destroy', $attendance_code->id))->assertRedirect('/login');
    }
}
