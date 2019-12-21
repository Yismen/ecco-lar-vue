<?php

use App\AttendanceCode;
use App\Employee;
use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Attendance::class, function (Faker $faker) {
    return [
        'date' => $faker->dateTimeBetween(Carbon::now()->subDays(5), Carbon::now()),
        'employee_id' => factory(Employee::class)->create(),
        'code_id' => factory(AttendanceCode::class)->create(),
        'user_id' => auth()->user() ? auth()->user()->id : factory(User::class)->create(),
        'comments' => $faker->text(150)
    ];
});
