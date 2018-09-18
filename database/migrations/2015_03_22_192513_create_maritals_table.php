<?php

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

        factory(App\Marital::class)->create(['id' => 1, 'name' => 'Married']);
        factory(App\Marital::class)->create(['id' => 2, 'name' => 'Single']);
        factory(App\Marital::class)->create(['id' => 3, 'name' => 'Common Law']);
        factory(App\Marital::class)->create(['id' => 4, 'name' => 'Divorced']);
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
