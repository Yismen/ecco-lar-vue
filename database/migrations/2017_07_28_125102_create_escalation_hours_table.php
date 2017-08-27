<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscalationHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escalation_hours', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('escal_clients');
            $table->time('entrance');
            $table->time('out');
            $table->double('break', 15, 8);
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
        Schema::drop('escalation_hours');
    }
}
