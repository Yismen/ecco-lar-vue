<?php

use Faker\Generator as Faker;

$factory->define(App\Marital::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
