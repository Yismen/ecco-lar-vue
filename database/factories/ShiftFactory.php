<?php

use Faker\Generator as Faker;

$factory->define(App\Shift::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'start' => $faker->time(),
        'end' => $faker->time()
    ];
});
