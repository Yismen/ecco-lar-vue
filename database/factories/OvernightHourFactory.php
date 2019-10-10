<?php

use Faker\Generator as Faker;

$factory->define(App\OvernightHour::class, function (Faker $faker) {
    return [
        'date' => $faker->date,
        'employee_id' => factory('App\Employee')->create(),
        'hours' => $faker->numberBetween(3, 12)
    ];
});
