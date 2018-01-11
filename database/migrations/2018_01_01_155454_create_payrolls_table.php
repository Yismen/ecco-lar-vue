<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->increments('id');
            
            $table->text('payroll_id')->nullable();
            $table->string('unique_id')->index();
            $table->date('from_date');
            $table->date('to_date');
            $table->date('payment_date');

            $table->integer('employee_id')->unsigned()->index();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->text('name')->nullable();
            $table->text('pay_per_hours')->nullable();
            $table->integer('position_id')->unsigned();
            $table->integer('payment_type_id')->unsigned();
            $table->integer('payment_frequency_id')->unsigned();
            $table->integer('department_id')->unsigned();

            $table->double('regular_incomes', 15, 8)->default(0.00);
            $table->double('nightly_incomes', 15, 8)->default(0.00);
            $table->double('holidays_incomes', 15, 8)->default(0.00);
            $table->double('overtime_incomes', 15, 8)->default(0.00);
            $table->double('training_incomes', 15, 8)->default(0.00);
            $table->double('incentive_incomes', 15, 8)->default(0.00);
            $table->double('other_incomes', 15, 8)->default(0.00);

            $table->double('ars_discounts', 15, 8)->nullable()->default(0.00);
            $table->double('afp_discounts', 15, 8)->nullable()->default(0.00);
            $table->double('other_discounts', 15, 8)->nullable()->default(0.00);

            $table->double('tss_payroll_incomes', 15, 8)->default(0.00);
            $table->double('gross_incomes', 15, 8)->default(0.00);
            $table->double('net_incomes', 15, 8)->default(0.00);
            $table->double('payment_incomes', 15, 8)->default(0.00);

            $table->boolean('paid')->default(false);
            $table->boolean('leased')->default(false);

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
        Schema::drop('payrolls');
    }
}
