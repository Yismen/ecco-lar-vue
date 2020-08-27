<?php

use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'contact_name' => $faker->name,
        'main_phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'secondary_phone' => $faker->phoneNumber,
        'account_number' => $faker->phoneNumber
    ];
});
