<?php

namespace Tests\Feature\Attendances;

use App\Attendance;
use App\AttendanceCode;
use App\Employee;
use App\Supervisor;
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
    public function it_lists_all_users_assigned_with_attendances()
    {
        $user = $this->userWithPermission('view-attendances'); 
        $this->be($user);
        $attendance = create(Attendance::class, ['date' => Carbon::now()]);
        $attendance->load(['employee', 'reporter', 'attendance_code']);
        
        $this->get(route('admin.attendances.index'))
            ->assertOk()
            ->assertViewIs('attendances.index')
            ->assertSee('My Employees:')
            ->assertSee('Attendance Event Date:')
            ->assertSee('Add a new Attendance')
            ->assertSee('Employee Name:')
            ->assertSee('Attendance Code:')
            ->assertSee('Date:')
            ->assertSee('Employee:')
            ->assertSee('Code:')
            ->assertSee('Reported By:')
            ->assertViewHas('attendances')
            ->assertSee($attendance->date->format('Y-m-d'))
            ->assertSee($attendance->employee->full_name)
            ->assertSee($attendance->reporter->name)
            ->assertSee($attendance->attendance_code->name)
            ;
    }

    /** @test */
    public function it_only_shows_attendances_for_a_given_date()
    {
        create(Attendance::class, ['date' => '2019-12-20'], 5);
        create(Attendance::class, ['date' => '2008-11-15'], 5);

        $this->actingAs($this->userWithPermission('view-attendances'))
            ->get(route('admin.attendances.index', ['date' => '2019-12-20']))
            ->assertSee('2019-12-20')
            ->assertDontSee('2008-11-15')
            ;
    }    

    /** @test */
    public function it_list_all_employees_assigned_to_an_user_and_not_other_uers()
    {
        $this->withoutExceptionHandling();
        $user1 = $this->userWithPermission('view-attendances');
        $user2 = create(User::class);
        $this->be($user1);

        $supervisor1 = create(Supervisor::class);        
        $supervisor2 = create(Supervisor::class);        
        $user1->supervisors()->sync((array) $supervisor1->id);
        $user2->supervisors()->sync((array) $supervisor2->id);

        $employee1 = create(Employee::class);
        $employee1->update(['supervisor_id' => $supervisor1->id]);
        $employee2 = create(Employee::class);
        $employee2->update(['supervisor_id' => $supervisor2->id]);
        
        $this->actingAs($user1)
            ->get(route('admin.attendances.index'))
            ->assertSee($employee1->full_name)
            ->assertDontSee($employee2->full_name)
            ;
    }

    /** @test */
    public function authorized_users_can_store_attendance()
    {
        $attendance = make(Attendance::class)->toArray();

        $this->withoutExceptionHandling();
        
        $this->actingAs($this->userWithPermission('create-attendances'))
            ->post(route('admin.attendances.store', $attendance))
            ->assertRedirect()
            ->assertLocation(route('admin.attendances.index'));

        $this->assertDatabaseHas('attendances', $attendance);
    }

    /** @test */
    public function authorized_users_can_see_edit_page()
    {
        $attendance = create(Attendance::class);

        $this->actingAs($this->userWithPermission('edit-attendances'))
            ->get(route('admin.attendances.edit', $attendance->id))
            ->assertOk()
            ->assertViewIs('attendances.edit')
            ->assertSee('Edit Attendance:')
            ->assertSee('Employee:')
            ->assertSee('Date:')
            ->assertSee('Code:')
            ->assertSee('Comments:')
            ->assertSee('UPDATE');
    }

    /** @test */
    public function authorized_users_can_update_attendance()
    {
        $attendance = create(Attendance::class);

        $employee = create(Employee::class);
        $code = create(AttendanceCode::class);

        $data_array = [
            'employee_id' => $employee->id,
            'date' => '2019-12-15 00:00:00',
            'code_id' => $code->id,
            'comments' => 'Updated Comment!'
        ];
        
        $this->actingAs($this->userWithPermission('edit-attendances'))
            ->put(route('admin.attendances.update', $attendance->id), array_merge($attendance->toArray(), $data_array))
            ->assertRedirect()
            ->assertLocation(route('admin.attendances.index'));

            $this->assertDatabaseHas('attendances', $data_array);
    }

    /** @test */
    public function authorized_users_can_destroy_attendance()
    {
        
        $attendance = create(Attendance::class);

        $this->actingAs($this->userWithPermission('destroy-attendances'))
            ->delete(route('admin.attendances.destroy', $attendance->id))
            ->assertRedirect()
            ->assertLocation(route('admin.attendances.index'));

        $this->assertDatabaseMissing('attendances', $attendance->toArray());
    }
}
