<?php

use App\Marital;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaritalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
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
        Marital::create(['id' => 3, 'name' => 'Common Law']);
        Marital::create(['id' => 4, 'name' => 'Divorced']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('maritals');
    }
}
