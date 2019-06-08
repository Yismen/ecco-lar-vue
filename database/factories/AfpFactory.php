<?php

use Faker\Generator as Faker;

$factory->define(App\Afp::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
