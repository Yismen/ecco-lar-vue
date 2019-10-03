<?php

use Faker\Generator as Faker;

$factory->define(App\PaymentType::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
