<?php

use Faker\Generator as Faker;

$factory->define(App\PaymentFrequency::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
