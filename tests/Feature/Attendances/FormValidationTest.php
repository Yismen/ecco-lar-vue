<?php

namespace Tests\Feature\Attendances;

use App\Attendance;
use App\Employee;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormValidationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function date_field_is_required()
    {
        $attendance = create(Attendance::class)->toArray();
        
        $this->actingAs($this->userWithPermission('create-attendances'))
            ->post(route('admin.attendances.store'), array_merge($attendance, ['date' => '']))
            ->assertSessionHasErrors('date');

        $this->actingAs($this->userWithPermission('edit-attendances'))
            ->put(route('admin.attendances.update', $attendance['id']), array_merge($attendance, ['date' => '']))
            ->assertSessionHasErrors('date');
    }

    /** @test */
    public function date_must_be_a_date()
    {
        $attendance = create(Attendance::class)->toArray();
        
        $this->actingAs($this->userWithPermission('create-attendances'))
            ->post(route('admin.attendances.store'), array_merge($attendance, ['date' => 'no a valid date']))
            ->assertSessionHasErrors('date');

        $this->actingAs($this->userWithPermission('edit-attendances'))
            ->put(route('admin.attendances.update', $attendance['id']), array_merge($attendance, ['date' => 'no a valid date']))
            ->assertSessionHasErrors('date');
    }

    /** @test */
    public function date_cant_be_futuristic()
    {
        $future_date = Carbon::now()->addDay();
        
        $attendance = make(Attendance::class)->toArray();
        $this->actingAs($this->userWithPermission('create-attendances'))
            ->post(route('admin.attendances.store'), array_merge($attendance, ['date' => $future_date]))
            ->assertSessionHasErrors('date');

        $attendance = create(Attendance::class)->toArray();
        $this->actingAs($this->userWithPermission('edit-attendances'))
            ->put(route('admin.attendances.update', $attendance['id']), array_merge($attendance, ['date' => $future_date]))
            ->assertSessionHasErrors('date');
    }

    /** @test */
    public function date_cant_be_older_than_10_days()
    {
        $attendance = create(Attendance::class)->toArray();
        $old_date = Carbon::now()->subDays(11);
        
        $this->actingAs($this->userWithPermission('create-attendances'))
            ->post(route('admin.attendances.store'), array_merge($attendance, ['date' => $old_date]))
            ->assertSessionHasErrors('date');

        $this->actingAs($this->userWithPermission('edit-attendances'))
            ->put(route('admin.attendances.update', $attendance['id']), array_merge($attendance, ['date' => $old_date]))
            ->assertSessionHasErrors('date');
    }

    /** @test */
    public function code_id_field_is_required()
    {
        $attendance = create(Attendance::class)->toArray();
        
        $this->actingAs($this->userWithPermission('create-attendances'))
            ->post(route('admin.attendances.store'), array_merge($attendance, ['code_id' => '']))
            ->assertSessionHasErrors('code_id');

        $this->actingAs($this->userWithPermission('edit-attendances'))
            ->put(route('admin.attendances.update', $attendance['id']), array_merge($attendance, ['code_id' => '']))
            ->assertSessionHasErrors('code_id');
    }

    /** @test */
    public function code_id_should_exists_on_users_table()
    {
        $attendance = create(Attendance::class)->toArray();
        
        $this->actingAs($this->userWithPermission('create-attendances'))
            ->post(route('admin.attendances.store'), array_merge($attendance, ['code_id' => 150]))
            ->assertSessionHasErrors('code_id');

        $this->actingAs($this->userWithPermission('edit-attendances'))
            ->put(route('admin.attendances.update', $attendance['id']), array_merge($attendance, ['code_id' => 150]))
            ->assertSessionHasErrors('code_id');
    }
    

    /** @test */
    public function employee_id_field_is_required()
    {
        $attendance = create(Attendance::class)->toArray();
        
        $this->actingAs($this->userWithPermission('create-attendances'))
            ->post(route('admin.attendances.store'), array_merge($attendance, ['employee_id' => '']))
            ->assertSessionHasErrors('employee_id');

        // $this->actingAs($this->userWithPermission('edit-attendances'))
        //     ->put(route('admin.attendances.update', $attendance['id']), array_merge($attendance, ['employee_id' => '']))
        //     ->assertSessionHasErrors('employee_id');
    }

    /** @test */
    // public function employee_id_should_exists_on_users_table()
    // {
    //     $attendance = create(Attendance::class)->toArray();
        
    //     $attendance = array_merge($attendance, ['employee_id' => [150]]);
        
    //     $this->actingAs($this->userWithPermission('create-attendances'))
    //         ->post(route('admin.attendances.store'), $attendance)
    //         ->assertSessionHasErrors('employee_id');

    //     $this->actingAs($this->userWithPermission('edit-attendances'))
    //         ->put(route('admin.attendances.update', $attendance['id']), array_merge($attendance, ['employee_id' => 150]))
    //         ->assertSessionHasErrors('employee_id');
    // }

    /** @test */
    // public function it_prevents_from_duplicating_rows()
    // {
    //     $attendance = create(Attendance::class)->toArray();
    //     $attendance2 = create(Attendance::class)->toArray();
        
    //     $this->actingAs($this->userWithPermission('create-attendances'))
    //         ->post(route('admin.attendances.store'), $attendance)
    //         ->assertSessionHasErrors('employee_id');

    //     $this->actingAs($this->userWithPermission('edit-attendances'))
    //         ->put(route('admin.attendances.update', $attendance['id']), $attendance2)
    //         ->assertSessionHasErrors('employee_id');
    // }
}
