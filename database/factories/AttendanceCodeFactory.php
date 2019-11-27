<?php

use Faker\Generator as Faker;

$factory->define(App\AttendanceCode::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(1),
        'color' => '#FFFFFF'
    ];
});
