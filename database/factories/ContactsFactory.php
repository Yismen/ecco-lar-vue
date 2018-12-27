<?php

use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class)->create(),
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'works_at' => $faker->company,
        'position' => $faker->jobTitle,
        'secondary_phone' => $faker->phoneNumber,
        'email' => $faker->email
    ];
});
