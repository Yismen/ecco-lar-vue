<?php

use Faker\Generator as Faker;

$factory->define(App\Employee::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'second_first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'second_last_name' => $faker->lastName,
        'hire_date' => $faker->date(),
        'personal_id' => $faker->unique()->numberBetween(10000000000, 99999999999),
        'passport' => '',
        'date_of_birth' => $faker->date(),
        'cellphone_number' => $faker->unique()->numberBetween(8091000001, 8099999999),
        // 'secondary_phone' => $faker->phoneNumber,
        'position_id' => factory(App\Position::class),
        'site_id' => factory(App\Site::class),
        'project_id' => factory(App\Project::class),
        'supervisor_id' => factory(App\Supervisor::class),
        'gender_id' => factory(App\Gender::class),
        'marital_id' => factory(App\Marital::class),
        'ars_id' => factory(App\Ars::class),
        'afp_id' => factory(App\Afp::class),
        'nationality_id' => factory(App\Nationality::class),
        'has_kids' => $faker->boolean(),
        'photo' => '',
    ];
});
