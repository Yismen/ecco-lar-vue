<?php

namespace Tests\Feature\Punches;

use App\Employee;
use App\Punch;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormValidationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function punch_field_is_required()
    {
        $punch = create(Punch::class)->toArray();
        
        $this->actingAs($this->userWithPermission('create-punches'))
            ->post(route('admin.punches.store'), array_merge($punch, ['punch' => '']))
            ->assertSessionHasErrors('punch');

        $this->actingAs($this->userWithPermission('edit-punches'))
            ->put(route('admin.punches.update', $punch['punch']), array_merge($punch, ['punch' => '']))
            ->assertSessionHasErrors('punch');
    }

    /** @test */
    public function punch_field_must_have_at_least_3_digits()
    {
        $punch = create(Punch::class)->toArray();

        $this->actingAs($this->userWithPermission('create-punches'))
            ->post(route('admin.punches.store'), array_merge($punch, ['punch' => 'aa']))
            ->assertSessionHasErrors('punch');

        $this->actingAs($this->userWithPermission('edit-punches'))
            ->put(route('admin.punches.update', $punch['punch']), array_merge($punch, ['punch' => 'aa']))
            ->assertSessionHasErrors('punch');
    }

    /** @test */
    public function punch_field_must_have_a_max_of_100_digits()
    {
        $punch = create(Punch::class)->toArray();

        $this->actingAs($this->userWithPermission('create-punches'))
            ->post(route('admin.punches.store'), array_merge($punch, ['punch' => $this->faker->words(150)]))
            ->assertSessionHasErrors('punch');

        $this->actingAs($this->userWithPermission('edit-punches'))
            ->put(route('admin.punches.update', $punch['punch']), array_merge($punch, ['punch' => $this->faker->words(150)]))
            ->assertSessionHasErrors('punch');
    }

    /** @test */
    public function punch_field_must_be_unique()
    {
        $punch = create(Punch::class)->toArray();
        $punch2 = create(Punch::class)->toArray();

        $this->actingAs($this->userWithPermission('create-punches'))
            ->post(route('admin.punches.store'), $punch)
            ->assertSessionHasErrors('punch');
            
        $this->actingAs($this->userWithPermission('edit-punches'))
            ->put(route('admin.punches.update', $punch['punch']), $punch2)
            ->assertSessionHasErrors('punch');

        $this->actingAs($this->userWithPermission('edit-punches'))
            ->put(route('admin.punches.update', $punch['punch']), $punch)
            ->assertSessionMissing('punch');
    }

    /** @test */
    public function employee_id_is_required()
    {
        $punch = create(Punch::class)->toArray();
        
        $this->actingAs($this->userWithPermission('create-punches'))
            ->post(route('admin.punches.store'), array_merge($punch, ['employee_id' => '']))
            ->assertSessionHasErrors('employee_id');

        $this->actingAs($this->userWithPermission('edit-punches'))
            ->put(route('admin.punches.update', $punch['punch']), array_merge($punch, ['employee_id' => '']))
            ->assertSessionHasErrors('employee_id');
    }

    /** @test */
    public function employee_id_must_exists_in_employees_table()
    {
        $punch = create(Punch::class)->toArray();
        
        $this->actingAs($this->userWithPermission('create-punches'))
            ->post(route('admin.punches.store'), array_merge($punch, ['employee_id' => 40]))
            ->assertSessionHasErrors('employee_id');

        $this->actingAs($this->userWithPermission('edit-punches'))
            ->put(route('admin.punches.update', $punch['punch']), array_merge($punch, ['employee_id' => 40]))
            ->assertSessionHasErrors('employee_id');
    }

    /** @test */
    public function employee_id_must_be_unique()
    {
        $employee = create(Employee::class);
        $punch = create(Punch::class, ['employee_id' => $employee->id])->toArray();
        
        $this->actingAs($this->userWithPermission('create-punches'))
            ->post(route('admin.punches.store'), array_merge($punch, ['employee_id' => $employee->id]))
            ->assertSessionHasErrors('employee_id');

        $this->actingAs($this->userWithPermission('edit-punches'))
            ->put(route('admin.punches.update', $punch['punch']), array_merge($punch, ['employee_id' => 40]))
            ->assertSessionHasErrors('employee_id');
    }
    
}
