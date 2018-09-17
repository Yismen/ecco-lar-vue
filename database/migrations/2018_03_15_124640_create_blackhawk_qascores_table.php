<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlackhawkQascoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blackhawk_qascores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id')->index()->unique();
            $table->string('client');
            $table->string('queue');
            $table->date('date');
            $table->integer('employee_id');
            $table->string('name', 100)->nullable();
            $table->string('status', 100)->nullable();
            $table->double('qa_score', 15, 8);
            $table->boolean('passing')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blackhawk_qascores');
    }
}
