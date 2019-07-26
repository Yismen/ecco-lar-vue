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
            $table->double('monday', 15, 8)->nullable()->default(0);
            $table->double('tuesday', 15, 8)->nullable()->default(0);
            $table->double('wednesday', 15, 8)->nullable()->default(0);
            $table->double('thursday', 15, 8)->nullable()->default(0);
            $table->double('friday', 15, 8)->nullable()->default(0);
            $table->double('saturday', 15, 8)->nullable()->default(0);
            $table->double('sunday', 15, 8)->nullable()->default(0);
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
