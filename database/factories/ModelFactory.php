<?php

use Carbon\Carbon;

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
$factory->define(App\Login::class, function (Faker\Generator $faker) {
    return [
        'login' => $faker->email,
        'employee_id' => random_int(50001, 50090),
        'system_id' => 6
    ];
});

$factory->define(App\Password::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'slug' => str_slug($faker->lastName),
        'title' => $faker->lastName,
        'url' => $faker->url,
        'username' => $faker->email,
        'password' => str_random(10),
    ];
});

$factory->define(App\Gender::class, function () {
    return ['gender' => 'Male', ];
});

$factory->define(App\EscalClient::class, function (Faker\Generator $faker) {
    return [
        'slug' => str_slug($faker->word),
        'name' => $faker->word,
    ];
});

$factory->define(App\Marital::class, function (Faker\Generator $faker) {
    return ['name' => $faker->name];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Task::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'task_name' => $faker->sentence,
    ];
});

$factory->define(App\Payment::class, function (Faker\Generator $faker) {
    return [
        'payment_type' => $faker->word,
    ];
});

$factory->define(App\Reason::class, function (Faker\Generator $faker) {
    return [
        'reason' => $faker->word,
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
    ];
});

$factory->define(App\Source::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\TerminationReason::class, function (Faker\Generator $faker) {
    return [
        'reason' => $faker->sentence,
        'description' => $faker->sentence,
    ];
});

$factory->define(App\TerminationType::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->sentence,
    ];
});

$factory->define(App\Production::class, function (Faker\Generator $faker) {
    return [
        'insert_date' => Carbon::today(),
        'employee_id' => $faker->randomElement(array_flatten((array)\App\Employee::pluck('id'))),
        'name' => $faker->name,
        'production_hours' => $faker->numberBetween(5, 12),
        'production' => $faker->numberBetween(100, 450),
        'reason_id' => $faker->randomElement(array_flatten((array)\App\Reason::pluck('id'))),
        'client_id' => $faker->randomElement(array_flatten((array)\App\Client::pluck('id'))),
        'source_id' => $faker->randomElement(array_flatten((array)\App\Source::pluck('id'))),
    ];
});

$factory->define(App\Downtime::class, function (Faker\Generator $faker) {
    $carbon = new Carbon;
    $employee_id = $faker->randomElement(array_flatten((array)\App\Employee::pluck('id')));
    $name = \App\Employee::find($employee_id)->fullName;
    return [
        'insert_date' => Carbon::today(),
        'year' => 'sr',
        'month' => 'sr',
        'week' => 'sr',
        'employee_id' => $employee_id,
        'name' => $name,
        'from_time' => $carbon->timestamp,
        'to_time' => $carbon->timestamp,
        'break_time' => 60,
        'total_hours' => $faker->randomFloat(2, 5, 10),
        'reason_id' => $faker->randomElement(array_flatten((array)\App\Reason::pluck('id'))),
        'unique_id' => $faker->randomNumber(3),
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
        'work_id' => $faker->randomElement(\App\Work::pluck('id')->toArray()),
        'client_id' => $faker->randomElement(\App\Client::pluck('id')->toArray()),
        'situation_id' => $faker->randomElement(\App\Situation::pluck('id')->toArray()),
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
