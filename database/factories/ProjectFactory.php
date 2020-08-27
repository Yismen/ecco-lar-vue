<?php

use App\Client;
use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'client_id' => factory(Client::class),
    ];
});
