<?php

use Faker\Generator as Faker;

$factory->define(App\Employee::class, function (Faker $faker) {
    return [
        'first_name' => $faker->name,
        'second_first_name' => $faker->name,
        'last_name' => $faker->name,
        'second_last_name' => $faker->name,
        'hire_date' => $faker->date(),
        'personal_id' => $faker->numberBetween(8091000001, 8099999999),
        'passport' => '',
        'date_of_birth' => $faker->date(),
        'cellphone_number' => $faker->phoneNumber,
        'secondary_phone' => $faker->phoneNumber,
        'position_id' => factory(App\Position::class)->create()->id,
        'site_id' => factory(App\Site::class)->create()->id,
        'project_id' => factory(App\Project::class)->create()->id,
        'supervisor_id' => factory(App\Supervisor::class)->create()->id,
        'gender_id' => factory(App\Gender::class)->create()->id,
        'marital_id' => factory(App\Marital::class)->create()->id,
        'ars_id' => factory(App\Ars::class)->create()->id,
        'afp_id' => factory(App\Afp::class)->create()->id,
        'nationality_id' => factory(App\Nationality::class)->create()->id,
        'has_kids' => $faker->boolean(),
        'photo' => '',
    ];
});
