<?php

use Faker\Generator as Faker;

$factory->define(App\Source::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
