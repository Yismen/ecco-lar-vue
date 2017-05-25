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
            $table->integer('employee_id')->unsigned()->index();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->text('name')->nullable();
            $table->text('name_slug')->nullable();

            $table->double('regular_income', 15, 8)->default(0.00);
            $table->double('nighly _income', 15, 8)->default(0.00);
            $table->double('holidays_income', 15, 8)->default(0.00);
            $table->double('overtime_income', 15, 8)->default(0.00);
            $table->double('training_income', 15, 8)->default(0.00);

            $table->double('incentive_incomes', 15, 8)->default(0.00);
            $table->double('other_incomes', 15, 8)->default(0.00);

            $table->double('ars_discount', 15, 8)->nullable()->default(0.00);
            $table->double('afp_discount', 15, 8)->nullable()->default(0.00);
            $table->double('other_discounts', 15, 8)->nullable()->default(0.00);

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