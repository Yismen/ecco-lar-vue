<?php

namespace Tests\Feature\Holidays;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleActionsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function authorized_users_can_see_holidays_list()
    {
        $holiday = create('App\Holiday')->toArray();
        $response = $this->actingAs($this->userWithPermission('view-holidays'));

        $response->get(route('admin.holidays.index'))
            ->assertOk()
            ->assertViewIs('holidays.index')
            ->assertSee('<h4>Create Holidays</h4>')
            ->assertSee('Holidays List');
    }

    /** @test */
    public function authorized_users_can_create_a_holiday()
    {
        $response = $this->actingAs($this->userWithPermission('create-holidays'));
        $holiday = raw('App\Holiday');

        $response->post(route('admin.holidays.store'), $holiday)
            ->assertRedirect(route('admin.holidays.index'));

        $this->assertDatabaseHas('holidays', [
            'date' => Carbon::parse($holiday['date']),
            'name' => $holiday['name'],
            'description' => $holiday['description']
        ]);
    }

    /** @test */
    public function authorized_users_can_see_edit_page()
    {
        // $this->disableExceptionHandling();
        $holiday = create('App\Holiday');
        $response = $this->actingAs($this->userWithPermission('edit-holidays'));

        $response->get(route('admin.holidays.edit', $holiday->id))
            ->assertOk()
            ->assertViewIs('holidays.edit')
            ->assertSee('Edit Holidays')
            ->assertSee($holiday->date->format('d-M-Y'))
            ->assertSee('Holiday Name:')
            ->assertSee(e($holiday->name))
            ->assertSee('UPDATE');
    }

    /** @test */
    public function authorized_users_can_update_holiday()
    {
        // $this->disableExceptionHandling();
        $holiday = create('App\Holiday');
        $updated = [
            'name' => 'Updated Name',
            'date' => Carbon::now(),
            'description' => 'Changed Description'
        ];

        $response = $this->actingAs($this->userWithPermission('edit-holidays'));

        $response->put(route('admin.holidays.update', $holiday->id), $updated)
            ->assertRedirect(route('admin.holidays.edit', $holiday->id));

        $this->assertDatabaseHas('holidays', $updated);
    }

    /** @test */
    public function authorized_users_can_destroy_holiday()
    {
        $this->disableExceptionHandling();
        $holiday = create('App\Holiday');
        $response = $this->actingAs($this->userWithPermission('destroy-holidays'));

        $response->delete(route('admin.holidays.destroy', $holiday->id))
            ->assertRedirect(route('admin.holidays.index'));

        $this->assertDatabaseMissing('holidays', [
            'id' => $holiday->id
        ]);
    }
}
