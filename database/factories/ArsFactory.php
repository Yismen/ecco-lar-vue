<?php

use Faker\Generator as Faker;

$factory->define(App\Ars::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
