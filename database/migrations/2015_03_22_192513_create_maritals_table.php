<?php

use App\Marital;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaritalsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('maritals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Marital::create(['id' => 1, 'name' => 'Married']);
        Marital::create(['id' => 2, 'name' => 'Single']);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('maritals');
    }
}
