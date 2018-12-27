<?php

use Faker\Generator as Faker;

$factory->define(App\Profile::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class)->create(),
        'gender' => 'male',
        'bio' => $faker->paragraph,
        'phone' => $faker->phoneNumber,
        'education' => $faker->paragraph,
        'skills' => $faker->paragraph,
        'work' => $faker->sentence,
        'location' => $faker->sentence
    ];
});
