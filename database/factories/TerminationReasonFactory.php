<?php

use Faker\Generator as Faker;

$factory->define(App\TerminationReason::class, function (Faker $faker) {
    return [
        'reason' => $faker->sentence,
        'description' => $faker->sentence,
    ];
});
