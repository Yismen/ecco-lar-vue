<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualityScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quality_scores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id', 150)->nullable();
            $table->integer('client_id')->unsigned()->index();
            $table->integer('employee_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->date('work_date');
            // $table->date('audit_date');
            $table->double('score', 15, 8);
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
        Schema::dropIfExists('quality_scores');
    }
}
