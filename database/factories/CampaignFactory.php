<?php

use Faker\Generator as Faker;

$factory->define(App\Campaign::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'project_id' => factory(App\Project::class)->create()->id,
        'source_id' => factory(App\Source::class)->create()->id,
        'revenue_type_id' => factory(App\RevenueType::class)->create()->id,
        'sph_goal' => $faker->randomDigit(),
        'revenue_rate' => $faker->randomDigit(),
    ];
});
