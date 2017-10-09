<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->string('name', 300)->nullable();
            $table->double('amount', 15, 8);
            $table->integer('concept_id')->unsigned();
            $table->foreign('concept_id')->references('id')->on('payroll_discount_concepts')->onDelete('cascade');
            $table->string('comment', 200)->nullable();
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
        Schema::drop('payroll_discounts');
    }
}
