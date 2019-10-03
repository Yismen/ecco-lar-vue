<?php

use Faker\Generator as Faker;

$factory->define(App\Position::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'department_id' => factory(App\Department::class)->create()->id,
        'payment_type_id' => factory(App\PaymentType::class)->create()->id,
        'payment_frequency_id' => factory(App\PaymentFrequency::class)->create()->id,
        'salary' => 125,
    ];
});
