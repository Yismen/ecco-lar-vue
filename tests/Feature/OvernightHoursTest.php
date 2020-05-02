<?php

namespace Tests\Feature;

use App\Employee;
use App\OvernightHour;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OvernightHoursTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** Authentication: Prevent access to unauthenticated users */
    public function testGuestCantAccess()
    {
        $overnight = create('App\OvernightHour');
        $this->withExceptionHandling();

        $this->get(route('admin.overnight_hours.index'))->assertRedirect('/login');
        // $this->get(route('admin.overnight_hours.show', $overnight->id))->assertRedirect('/login');
        $this->get(route('admin.overnight_hours.create'))->assertRedirect('/login');
        $this->post(route('admin.overnight_hours.store', $overnight->toArray()))->assertRedirect('/login');
        $this->get(route('admin.overnight_hours.edit', $overnight->id))->assertRedirect('/login');
        $this->put(route('admin.overnight_hours.update', $overnight->id))->assertRedirect('/login');
        $this->delete(route('admin.overnight_hours.destroy', $overnight->id))->assertRedirect('/login');
    }

    /** Authorization: Prevent access to unauthorizated users */
    public function testUnuthorizedUsersCantAccess()
    {
        $this->withExceptionHandling();
        $hour = create('App\OvernightHour');
        $response = $this->actingAs($this->userWithPermission('wrong-permission'));

        $response->get(route('admin.overnight_hours.index'))
            ->assertForbidden();

        // $response->get(route('admin.overnight_hours.show', $hour->id))
        //     ->assertForbidden();

        $response->get(route('admin.overnight_hours.create'))
            ->assertForbidden();

        $response->post(route('admin.overnight_hours.store'))
            ->assertForbidden();

        $response->get(route('admin.overnight_hours.edit', $hour->id))
            ->assertForbidden();

        $response->put(route('admin.overnight_hours.update', $hour->id))
            ->assertForbidden();

        $response->delete(route('admin.overnight_hours.destroy', $hour->id))
            ->assertForbidden();
    }

    /** Validations: Validate fields to reate */
    public function testValidateStoringOvernightHour()
    {
        $this->withExceptionHandling();
        // $employee = create(Employee::class);
        $hour = create(OvernightHour::class)->toArray();

        $response = $this->actingAs($this->userWithPermission('create-overnight-hours'));

        // Date field is required
        $response->post(route('admin.overnight_hours.store'), array_merge($hour, ['date' => '']))
            // ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('date');

        // Date field must be a date
        $response->post(route('admin.overnight_hours.store'), array_merge($hour, ['date' => 'Invalid date']))
            // ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('date');

        // Date field must be unique for the same employee
        $response->post(route('admin.overnight_hours.store'), array_merge($hour, ['date' => Carbon::parse($hour['date'])->format('Y-m-d')]))
            // ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('date');

        // Employee id is required
        $response->post(route('admin.overnight_hours.store'), array_merge($hour, ['employee_id' => '']))
            // ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('employee_id');

        // Employee id must exists in employees table
        $response->post(route('admin.overnight_hours.store'), array_merge($hour, ['employee_id' => 'Not existent']))
            // ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('employee_id');

        // Hours must be a number
        $response->post(route('admin.overnight_hours.store'), array_merge($hour, ['hours' => 'String']))
            // ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('hours');

        // Hours field cant be less than 0
        $response->post(route('admin.overnight_hours.store'), array_merge($hour, ['hours' => -45]))
            // ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('hours');

        // Hours field cant be more than 14
        $response->post(route('admin.overnight_hours.store'), array_merge($hour, ['hours' => 17.0001]))
            // ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('hours');
    }

    /** Validations: Validate fields to update */
    public function testValidateUpdatingOvernightHour()
    {
        $this->withExceptionHandling();
        // $employee = create(Employee::class);
        $hour = create(OvernightHour::class)->toArray();

        $response = $this->actingAs($this->userWithPermission('edit-overnight-hours'));

        // Hours must be a number
        $response->put(route('admin.overnight_hours.update', $hour['id']), array_merge($hour, ['hours' => 'String']))
            // ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('hours');

        // Hours field cant be less than 0
        $response->put(route('admin.overnight_hours.update', $hour['id']), array_merge($hour, ['hours' => -45]))
            // ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('hours');

        // Hours field cant be more than 14
        $response->put(route('admin.overnight_hours.update', $hour['id']), array_merge($hour, ['hours' => 17.0001]))
            // ->assertRedirect(url()->previous())
            ->assertSessionHasErrors('hours');
    }

    /** Authorization: Grant access to authorizated users to see */
    public function testAuthorizedUsersCanSeeOvernightHours()
    {
        $hour = create('App\OvernightHour');
        $response = $this->actingAs($this->userWithPermission('view-overnight-hours'));

        $response->get(route('admin.overnight_hours.index'))
            ->assertOk()
            ->assertViewIs('overnight-hours.index')
            ->assertSee('Create Overnight Hours Manually')
            ->assertSee('Only if extremely necessary. Try to avoid this practice')
            ->assertSee('Overnight Hours List');
    }

    /** Authorization: Grant access to authorizated users to create/store */
    public function testAuthorizedUsersCanCreateOvernightHours()
    {
        $employee = create(Employee::class);
        $response = $this->actingAs($this->userWithPermission('create-overnight-hours'));

        $response->post(route('admin.overnight_hours.store'), [
            'date' => '2019-09-05',
            'employee_id' => $employee->id,
            'hours' => 8,
        ])
            ->assertRedirect(route('admin.overnight_hours.index'));

        $this->assertDatabaseHas('overnight_hours', [
            'date' => Carbon::make('2019-09-05'),
            'employee_id' => $employee->id,
            'hours' => 8,
        ]);
    }

    /** Authorization: Grant access to authorizated users to edit/update */
    public function testAuthorizedUsersCanEditOvernightHours()
    {
        // $this->disableExceptionHandling();
        $hour = create(OvernightHour::class);
        $response = $this->actingAs($this->userWithPermission('edit-overnight-hours'));

        $response->get(route('admin.overnight_hours.edit', $hour->id))
            ->assertOk()
            ->assertViewIs('overnight-hours.edit')
            ->assertSee('Edit Overnight Hours')
            ->assertSee($hour->date->format('d-M-Y'))
            ->assertSee('Overnight Hours:')
            ->assertSee($hour->hours)
            ->assertSee('UPDATE')
            ->assertSee($hour->employee->full_name);

        $response->put(route('admin.overnight_hours.update', $hour->id), [
            'hours' => 4.2354568755645,
        ])
            ->assertRedirect(route('admin.overnight_hours.edit', $hour->id));

        $this->assertDatabaseHas('overnight_hours', [
            'id' => $hour->id,
            'date' => Carbon::make($hour->date),
            'employee_id' => $hour->employee->id,
            'hours' => 4.2354568755645,
        ]);
    }

    /** Authorization: Grant access to authorizated users to destroy */
    public function testAuthorizedUsersCanDestroyOvernightHours()
    {
        // $this->disableExceptionHandling();
        $hour = create(OvernightHour::class);
        $response = $this->actingAs($this->userWithPermission('destroy-overnight-hours'));

        $response->delete(route('admin.overnight_hours.destroy', $hour->id))
            ->assertRedirect(route('admin.overnight_hours.index'));

        $this->assertDatabaseMissing('overnight_hours', [
            'id' => $hour->id
        ]);
    }
}
