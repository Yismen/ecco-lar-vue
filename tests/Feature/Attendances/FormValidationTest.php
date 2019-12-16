<?php

namespace Tests\Feature\Attendances;

use App\Attendance;
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
        $attendance = create(Attendance::class)->toArray();
        
        $this->actingAs($this->userWithPermission('create-attendances'))
            ->post(route('admin.attendances.store'), array_merge($attendance, ['name' => '']))
            ->assertSessionHasErrors('name');

        $this->actingAs($this->userWithPermission('edit-attendances'))
            ->put(route('admin.attendances.update', $attendance['id']), array_merge($attendance, ['name' => '']))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_field_must_have_at_least_4_digits()
    {
        $attendance = create(Attendance::class)->toArray();

        $this->actingAs($this->userWithPermission('create-attendances'))
            ->post(route('admin.attendances.store'), array_merge($attendance, ['name' => 'Aaa']))
            ->assertSessionHasErrors('name');

        $this->actingAs($this->userWithPermission('edit-attendances'))
            ->put(route('admin.attendances.update', $attendance['id']), array_merge($attendance, ['name' => 'Aaa']))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_field_must_have_a_max_of_150_digits()
    {
        $attendance = create(Attendance::class)->toArray();

        $this->actingAs($this->userWithPermission('create-attendances'))
            ->post(route('admin.attendances.store'), array_merge($attendance, ['name' => $this->faker->words(180)]))
            ->assertSessionHasErrors('name');

        $this->actingAs($this->userWithPermission('edit-attendances'))
            ->put(route('admin.attendances.update', $attendance['id']), array_merge($attendance, ['name' => $this->faker->words(180)]))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_field_must_be_unique()
    {
        $attendance = create(Attendance::class)->toArray();
        $attendance2 = create(Attendance::class)->toArray();

        $this->actingAs($this->userWithPermission('create-attendances'))
            ->post(route('admin.attendances.store'), $attendance)
            ->assertSessionHasErrors('name');
            
        $this->actingAs($this->userWithPermission('edit-attendances'))
            ->put(route('admin.attendances.update', $attendance['id']), $attendance2)
            ->assertSessionHasErrors('name');

        $this->actingAs($this->userWithPermission('edit-attendances'))
            ->put(route('admin.attendances.update', $attendance['id']), $attendance)
            ->assertSessionMissing('name');
    }

    /** @test */
    public function color_field_cant_be_black()
    {        
        $attendance = create(Attendance::class)->toArray();
        
        $this->actingAs($this->userWithPermission('create-attendances'))
            ->post(route('admin.attendances.store'), array_merge($attendance, ['color' => '#000']))
            ->assertSessionHasErrors('color');
        
        // $this->actingAs($this->userWithPermission('create-attendances'))
        //     ->post(route('admin.attendances.store'), array_merge($attendance, ['color' => '#000000']))
        //     ->assertSessionHasErrors('color');

        $this->actingAs($this->userWithPermission('edit-attendances'))
            ->put(route('admin.attendances.update', $attendance['id']), array_merge($attendance, ['color' => '#000']))
            ->assertSessionHasErrors('color');

        // $this->actingAs($this->userWithPermission('edit-attendances'))
        //     ->put(route('admin.attendances.update', $attendance['id']), array_merge($attendance, ['color' => '#000000']))
        //     ->assertSessionHasErrors('color');
    }

    /** @test */
    public function color_field_must_be_unique()
    {
        $attendance = create(Attendance::class)->toArray();
        $attendance2 = create(Attendance::class)->toArray();

        $this->actingAs($this->userWithPermission('create-attendances'))
            ->post(route('admin.attendances.store'), $attendance)
            ->assertSessionHasErrors('color');
            
        $this->actingAs($this->userWithPermission('edit-attendances'))
            ->put(route('admin.attendances.update', $attendance['id']), $attendance2)
            ->assertSessionHasErrors('color');

        $this->actingAs($this->userWithPermission('edit-attendances'))
            ->put(route('admin.attendances.update', $attendance['id']), $attendance)
            ->assertSessionMissing('color');
    }
}
