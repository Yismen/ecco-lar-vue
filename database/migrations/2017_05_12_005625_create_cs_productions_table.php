<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCsProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cs_productions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id', 100)->index();
            $table->date('production_date');
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->string('name', 150)->nullable();
            $table->integer('source_id')->unsigned();
            $table->foreign('source_id')->references('id')->on('sources')->onDelete('cascade');
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade'); 
            $table->integer('b_line_id')->unsigned();
            $table->foreign('b_line_id')->references('id')->on('b_lines')->onDelete('cascade');
            $table->integer('records')->unsigned()->default(0);
            $table->double('time', 15, 2)->nullable()->default(0.00);
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
        Schema::drop('cs_productions');
    }
}
