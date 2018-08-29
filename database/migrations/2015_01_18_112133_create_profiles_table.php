<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->unique();
            $table->enum('gender', ['male', 'female']);
            $table->string('bio', 4000)->nullable();
            $table->string('phone', 300)->nullable();
            $table->string('education', 800)->nullable();
            $table->string('skills', 500)->nullable();
            $table->string('work', 150)->nullable();
            $table->string('location', 500)->nullable();
            $table->string('photo', 500)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profiles');
    }
}
