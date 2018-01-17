<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_admin')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        factory(App\User::class)->create([
            'name' => 'Yismen Jorge', // $faker->name,
            'email' => 'yismen.jorge@gmail.com', // $faker->email,
            'password' => bcrypt('password'), // bcrypt(str_random(10)),
            'remember_token' => str_random(10),
            'is_active ' => 1,
            'is_admin ' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
