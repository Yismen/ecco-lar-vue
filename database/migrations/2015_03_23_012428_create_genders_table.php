<?php

use App\Gender;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genders', function (Blueprint $table) {
            $table->increments('id');
            // $table->string('gender', 30)->unique();
            $table->string('name', 30)->unique();
            $table->timestamps();
        });

        Gender::create(['id' => 1, 'name' => 'Male']);
        Gender::create(['id' => 2, 'name' => 'Female']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genders');
    }
}
