<?php

use App\Nationality;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNationalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nationalities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150)->unique();
            $table->timestamps();
        });

        Nationality::create(['name' => 'Dominicano']);
        Nationality::create(['name' => 'Hantiano']);
        Nationality::create(['name' => 'Venezolano']);
        Nationality::create(['name' => 'Estadounidense']);
        Nationality::create(['name' => 'Puertoriqueño']);
        Nationality::create(['name' => 'Mexicano']);
        Nationality::create(['name' => 'Israelí']);
        Nationality::create(['name' => 'Argentino']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nationalities');
    }
}
