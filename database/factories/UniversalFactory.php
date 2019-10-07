<?php

use Faker\Generator as Faker;

$factory->define(App\Universal::class, function (Faker $faker) {
    return [
        'employee_id' => factory(App\Employee::class)->create()->id,
        'since' => $faker->date(),
    ];
});
