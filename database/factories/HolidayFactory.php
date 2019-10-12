<?php

use Faker\Generator as Faker;

$factory->define(App\Holiday::class, function (Faker $faker) {
    return [
        'date' => $faker->date,
        'name' => $faker->text(50),
        'description' => $faker->text(80)
    ];
});
