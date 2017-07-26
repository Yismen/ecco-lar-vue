<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateNightlyIncomeFieldNameAndAddPaymentDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payroll_temps', function (Blueprint $table) {
            $table->renameColumn('"nighly _income"', '"nightly_income"')->after('regular_income');
            $table->date('payment_date')->after('to_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payroll_temps', function (Blueprint $table) {
            $table->renameColumn('"nightly_income"', '"nighly _income"')->after('regular_income');
            $table->dropColumn('payment_date');
        });
    }
}
