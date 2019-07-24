<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShifts2Table extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned();
            $table->string('slug', 100)->nullable();
            $table->time('start_at')->default('07:00:00');
            $table->time('end_at')->default('16:00:00');
            $table->double('mondays', 15, 8)->default(0);
            $table->double('tuesdays', 15, 8)->default(0);
            $table->double('wednesdays', 15, 8)->default(0);
            $table->double('thursdays', 15, 8)->default(0);
            $table->double('fridays', 15, 8)->default(0);
            $table->double('saturdays', 15, 8)->default(0);
            $table->double('sundays', 15, 8)->default(0);
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('shifts');
    }
}
