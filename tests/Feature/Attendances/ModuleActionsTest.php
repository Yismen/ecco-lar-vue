<?php

namespace Tests\Feature\Attendances;

use App\Attendance;
use App\AttendanceCode;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleActionsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_lists_all_users_assigned_with_supervisor()
    {
        $attendance = create(Attendance::class);

        $this->actingAs($this->userWithPermission('view-supervisor-users'))
            ->get(route('admin.supervisor_users.index'))
            ->assertOk()
            ->assertViewIs('attendances.index')
            ->assertSee('Attendance Event Date:')
            ->assertSee('Add a new Attendance')
            ->assertSee('Employee Name:')
            ->assertSee('Attendance Code:')
            ->assertSee('Date:')
            ->assertSee('Employee:')
            ->assertSee('Code:')
            ->assertSee('Reported By:')
            ->assertSee($attendance->date->format('Y-m-d'))
            ->assertSee($attendance->employee->full_name)
            ->assertSee($attendance->attendance_code->name)
            ->assertSee($attendance->reporter->name)
            ;
    }

    /** @test */
    public function it_only_shows_attendances_for_a_given_date()
    {}    

    /** @test */
    public function it_list_all_employees_assigned_to_an_user()
    {} 

    /** @test */
    public function it_only_lists_employees_assigned_to_an_user()
    {}

    /** @test */
    public function it_sumirize_montly_attendances_for_a_particular_employee()
    {}
}
