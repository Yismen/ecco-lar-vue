<?php

namespace Tests\Feature\AttendanceCodes;

use App\AttendanceCode;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormValidationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function name_field_is_required()
    {
        $attendance_code = create(AttendanceCode::class)->toArray();
        
        $this->actingAs($this->userWithPermission('create-attendance-codes'))
            ->post(route('admin.attendance_codes.store'), array_merge($attendance_code, ['name' => '']))
            ->assertSessionHasErrors('name');

        $this->actingAs($this->userWithPermission('edit-attendance-codes'))
            ->put(route('admin.attendance_codes.update', $attendance_code['id']), array_merge($attendance_code, ['name' => '']))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_field_must_have_at_least_4_digits()
    {
        $attendance_code = create(AttendanceCode::class)->toArray();

        $this->actingAs($this->userWithPermission('create-attendance-codes'))
            ->post(route('admin.attendance_codes.store'), array_merge($attendance_code, ['name' => 'Aaa']))
            ->assertSessionHasErrors('name');

        $this->actingAs($this->userWithPermission('edit-attendance-codes'))
            ->put(route('admin.attendance_codes.update', $attendance_code['id']), array_merge($attendance_code, ['name' => 'Aaa']))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_field_must_have_a_max_of_150_digits()
    {
        $attendance_code = create(AttendanceCode::class)->toArray();

        $this->actingAs($this->userWithPermission('create-attendance-codes'))
            ->post(route('admin.attendance_codes.store'), array_merge($attendance_code, ['name' => $this->faker->words(180)]))
            ->assertSessionHasErrors('name');

        $this->actingAs($this->userWithPermission('edit-attendance-codes'))
            ->put(route('admin.attendance_codes.update', $attendance_code['id']), array_merge($attendance_code, ['name' => $this->faker->words(180)]))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    // public function name_field_must_be_unique()
    // {
    //     $attendance_code = create(AttendanceCode::class)->toArray();
    //     $newAC = make(AttendanceCode::class)->toArray();
    //     $attendance_code2 = create(AttendanceCode::class)->toArray();
        
        // $this->actingAs($this->userWithPermission('create-attendance-codes'))
        //     ->post(
        //         route('admin.attendance_codes.store'), 
        //         array_merge( $newAC, ['name' =>$attendance_code['name']])
        //     )
        //     ->assertSessionHasErrors('name');
            
        // $this->actingAs($this->userWithPermission('edit-attendance-codes'))
        //     ->put(route('admin.attendance_codes.update', $attendance_code['id']), $attendance_code2)
        //     ->assertSessionHasErrors('name');

        // $this->actingAs($this->userWithPermission('edit-attendance-codes'))
        //     ->put(route('admin.attendance_codes.update', $attendance_code['id']), $attendance_code)
        //     ->assertSessionMissing('name');
    // }

    /** @test */
    public function color_field_cant_be_black()
    {        
        $attendance_code = create(AttendanceCode::class)->toArray();
        
        $this->actingAs($this->userWithPermission('create-attendance-codes'))
            ->post(route('admin.attendance_codes.store'), array_merge($attendance_code, ['color' => '#000']))
            ->assertSessionHasErrors('color');
        
        // $this->actingAs($this->userWithPermission('create-attendance-codes'))
        //     ->post(route('admin.attendance_codes.store'), array_merge($attendance_code, ['color' => '#000000']))
        //     ->assertSessionHasErrors('color');

        $this->actingAs($this->userWithPermission('edit-attendance-codes'))
            ->put(route('admin.attendance_codes.update', $attendance_code['id']), array_merge($attendance_code, ['color' => '#000']))
            ->assertSessionHasErrors('color');

        // $this->actingAs($this->userWithPermission('edit-attendance-codes'))
        //     ->put(route('admin.attendance_codes.update', $attendance_code['id']), array_merge($attendance_code, ['color' => '#000000']))
        //     ->assertSessionHasErrors('color');
    }

    /** @test */
    public function color_field_must_be_unique()
    {
        $attendance_code = create(AttendanceCode::class)->toArray();
        $attendance_code2 = create(AttendanceCode::class)->toArray();

        $this->actingAs($this->userWithPermission('create-attendance-codes'))
            ->post(route('admin.attendance_codes.store'), $attendance_code)
            ->assertSessionHasErrors('color');
            
        $this->actingAs($this->userWithPermission('edit-attendance-codes'))
            ->put(route('admin.attendance_codes.update', $attendance_code['id']), $attendance_code2)
            ->assertSessionHasErrors('color');

        $this->actingAs($this->userWithPermission('edit-attendance-codes'))
            ->put(route('admin.attendance_codes.update', $attendance_code['id']), $attendance_code)
            ->assertSessionMissing('color');
    }
}
