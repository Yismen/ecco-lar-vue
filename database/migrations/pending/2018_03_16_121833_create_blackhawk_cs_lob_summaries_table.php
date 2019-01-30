<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlackhawkCSLobSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blackhawk_cs_lob_summaries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id')->index()->unique();
            $table->date('date');
            $table->string('queue');
            $table->integer('employee_id');
            $table->string('name', 100)->nullable();
            $table->string('lob', 100)->nullable();
            $table->integer('records');
            $table->double('production_time', 15, 8);
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
        Schema::dropIfExists('blackhawk_cs_lob_summaries');
    }
}
