<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});



// $factory->define(App\User::class, function (Faker\Generator $faker) {
//     return [
//         'name' => 'Yismen Jorge',
//         'email' => 'yismen.jorge@gmail.com',
//         'password' => bcrypt('jimmagic32'),
//         'remember_token' => str_random(10),
//     ];
// });
// 
// 
// 

           
$factory->define(App\Note::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->text(1500),
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'comment' => $faker->text(150),
        'work_id' => $faker->randomElement(\App\Work::lists('id')->toArray()),
        'client_id' => $faker->randomElement(\App\Client::lists('id')->toArray()),
        'situation_id' => $faker->randomElement(\App\Situation::lists('id')->toArray()),
    ];
});

$factory->define(App\Client::class, function (Faker\Generator $faker) {
    return [
        'client' => $faker->name,
        // 'slug' => str_slug($faker->name),
    ];
});

$factory->define(App\Situation::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        // 'slug' => str_slug($faker->name),
    ];
});

$factory->define(App\Work::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        // 'slug' => str_slug($faker->name),
    ];
});