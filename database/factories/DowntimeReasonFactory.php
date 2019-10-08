<?php

use Faker\Generator as Faker;

$factory->define(App\DowntimeReason::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
