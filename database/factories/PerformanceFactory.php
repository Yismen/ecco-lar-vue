<?php

use Carbon\Carbon;
use Faker\Generator as Faker;
$factory->define(App\Performance::class, function (Faker $faker) {
    $date = Carbon::now();
    $employee = factory(App\Employee::class)->create();
    $campaign = factory(App\Campaign::class)->create();
    $supervisor = factory(App\Supervisor::class)->create();

    return [
        'unique_id' => "{$date->format('Y-m-d')}-{$employee->id}-{$campaign->id}",
        'date' => $date->format('Y-m-d'),
        'employee_id' => $employee->id,
        'name' => $employee->fullName,
        'campaign_id' => $campaign->id,
        'supervisor_id' => $supervisor->id,
        'sph_goal' => 10,
        'login_time' => 8,
        'production_time' => 7.5,
        'talk_time' => 7.25,
        'billable_hours' => 7,
        'contacts' => 1500,
        'calls' => 6537,
        'transactions' => 12,
        'upsales' => 0,
        'cc_sales' => 0,
        'revenue' => 150,
        'downtime_reason_id' => null,
        'reported_by' => null,
        'file_name' => "faker_file_{$date->format('Ymd_His')}.xlsx"
    ];
});
