<?php

namespace Tests\Feature\Attendances;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testGuestCantViewAttendances()
    {
        $attendance = create('App\Attendance');
        
        $this->get(route('admin.attendances.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
        $this->get(route('admin.attendances.show', $attendance->id))
            ->assertStatus(302)    
            ->assertRedirect(route('login'));
    }

    public function testGuestCantCreateAttendances()
    {
        $attendance = create('App\Attendance');
        
        $this->get(route('admin.attendances.create'))
            ->assertStatus(302)    
            ->assertRedirect(route('login'));
        $this->post(route('admin.attendances.store'), $attendance->toArray())
            ->assertStatus(302)    
            ->assertRedirect(route('login'));
    }

    public function testGuestCantUpdateAttendance()
    {
        $attendance = create('App\Attendance');        
        
        $this->get(route('admin.attendances.edit', $attendance->id))
            ->assertStatus(302)    
            ->assertRedirect(route('login'));
        $this->put(route('admin.attendances.update', $attendance->id), $attendance->toArray())
            ->assertStatus(302)    
            ->assertRedirect(route('login'));
    }

    public function testGuestCantDestroyAttendance()
    {
        $attendance = create('App\Attendance');        
        
        $this->delete(route('admin.attendances.destroy', $attendance->id))
            ->assertStatus(302)    
            ->assertRedirect(route('login'));
    }
}
