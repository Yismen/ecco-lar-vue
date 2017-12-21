<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollIncentivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_incentives', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->string('name', 300)->nullable();
            $table->double('incentive_amount', 15, 8);
            $table->integer('concept_id')->unsigned();
            $table->foreign('concept_id')->references('id')->on('payroll_incentive_concepts');
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
        Schema::drop('payroll_incentives');
    }
}
