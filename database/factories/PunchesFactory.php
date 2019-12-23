<?php

use Faker\Generator as Faker;

$factory->define(App\Punch::class, function (Faker $faker) {
    return [
        'employee_id' => factory(App\Employee::class),
        'punch' => $faker->numberBetween(10000, 99999)
    ];
});
