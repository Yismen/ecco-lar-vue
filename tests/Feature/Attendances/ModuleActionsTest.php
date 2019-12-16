<?php

namespace Tests\Feature\Attendances;

use App\Attendance;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleActionsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function authorized_users_can_see_attendances_list()
    {
        $attendance = create('App\Attendance')->toArray();
        $response = $this->actingAs($this->userWithPermission('view-attendances'));

        $response->get(route('admin.attendances.index'))
            ->assertOk()
            ->assertViewIs('attendances.index');
    }

    /** @test */
    public function authorized_users_can_create_a_attendance()
    {
        $response = $this->actingAs($this->userWithPermission('create-attendances'));
        $attendance = make('App\Attendance', [
            'color' => '#sdffdd'
        ])->toArray();

        $response->post(route('admin.attendances.store'), $attendance)
            ->assertRedirect(route('admin.attendances.index'));

        $this->assertDatabaseHas('attendances', [
            'name' => $attendance['name'],
            'color' => $attendance['color']
        ]);
    }

    /** @test */
    public function authorized_users_can_see_edit_page()
    {
        $attendance = create('App\Attendance');
        $response = $this->actingAs($this->userWithPermission('edit-attendances'));

        $response->get(route('admin.attendances.edit', $attendance->id))
            ->assertOk()
            ->assertViewIs('attendances.edit')
            ->assertSee('Edit Attendance Code')
            ->assertSee($attendance->color)
            ->assertSee('Name:')
            ->assertSee(e($attendance->name))
            ->assertSee('UPDATE');
    }

    /** @test */
    public function authorized_users_can_update_attendance()
    {
        $attendance = create('App\Attendance');
        $updated = [
            'name' => 'Updated Name',
            'color' => '#F4f4f4'
        ];

        $response = $this->actingAs($this->userWithPermission('edit-attendances'));

        $response->put(route('admin.attendances.update', $attendance->id), $updated)
            ->assertRedirect(route('admin.attendances.edit', $attendance->id));

            $this->assertDatabaseMissing('attendances', $attendance->toArray());

            $this->assertDatabaseHas('attendances', $updated);
    }

    /** @test */
    // public function authorized_users_can_destroy_attendance()
    // {
    //     // $this->disableExceptionHandling();
    //     $attendance = create('App\Attendance');
    //     $response = $this->actingAs($this->userWithPermission('destroy-attendances'));

    //     $response->delete(route('admin.attendances.destroy', $attendance->id))
    //         ->assertRedirect(route('admin.attendances.index'));

    //     $this->assertDatabaseMissing('attendances', [
    //         'id' => $attendance->id
    //     ]);
    // }
}
