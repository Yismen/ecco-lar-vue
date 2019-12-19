<?php

namespace Tests\Feature\Attendances;

use App\Attendance;
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
    public function employee_id_field_is_required()
    {
        $attendance = create(Attendance::class)->toArray();
        
        $this->actingAs($this->userWithPermission('create-attendances'))
            ->post(route('admin.attendances.store'), array_merge($attendance, ['employee_id' => '']))
            ->assertSessionHasErrors('employee_id');

        $this->actingAs($this->userWithPermission('edit-attendances'))
            ->put(route('admin.attendances.update', $attendance['id']), array_merge($attendance, ['employee_id' => '']))
            ->assertSessionHasErrors('employee_id');
    }

    /** @test */
    public function employee_id_should_exists_on_users_table()
    {
        $attendance = create(Attendance::class)->toArray();
        
        $this->actingAs($this->userWithPermission('create-attendances'))
            ->post(route('admin.attendances.store'), array_merge($attendance, ['employee_id' => 150]))
            ->assertSessionHasErrors('employee_id');

        $this->actingAs($this->userWithPermission('edit-attendances'))
            ->put(route('admin.attendances.update', $attendance['id']), array_merge($attendance, ['employee_id' => 150]))
            ->assertSessionHasErrors('employee_id');
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
    // public function user_id_field_is_required()
    // {
    //     $attendance = create(Attendance::class)->toArray();
        
    //     $this->actingAs($this->userWithPermission('create-attendances'))
    //         ->post(route('admin.attendances.store'), array_merge($attendance, ['user_id' => '']))
    //         ->assertSessionHasErrors('user_id');

    //     $this->actingAs($this->userWithPermission('edit-attendances'))
    //         ->put(route('admin.attendances.update', $attendance['id']), array_merge($attendance, ['user_id' => '']))
    //         ->assertSessionHasErrors('user_id');
    // }

    /** @test */
    // public function user_id_should_exists_on_users_table()
    // {
    //     $attendance = create(Attendance::class)->toArray();
        
    //     $this->actingAs($this->userWithPermission('create-attendances'))
    //         ->post(route('admin.attendances.store'), array_merge($attendance, ['user_id' => 150]))
    //         ->assertSessionHasErrors('user_id');

    //     $this->actingAs($this->userWithPermission('edit-attendances'))
    //         ->put(route('admin.attendances.update', $attendance['id']), array_merge($attendance, ['user_id' => 150]))
    //         ->assertSessionHasErrors('user_id');
    // }
    

    /** @test */
    public function it_prevents_from_duplicating_rows()
    {
        $attendance = create(Attendance::class)->toArray();
        
        $this->actingAs($this->userWithPermission('create-attendances'))
            ->post(route('admin.attendances.store'), array_merge($attendance))
            ->assertSessionHasErrors('code_id');

        $this->actingAs($this->userWithPermission('edit-attendances'))
            ->put(route('admin.attendances.update', $attendance['id']), array_merge($attendance))
            ->assertSessionHasErrors('code_id');
    }
}
