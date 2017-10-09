<?php

use App\PayrollAdditionalConcept;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollAdditionalConceptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_additional_concepts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->timestamps();
        });

        PayrollAdditionalConcept::create(['name' => 'Bonus']);
        PayrollAdditionalConcept::create(['name' => 'Dead in the Family']);
        PayrollAdditionalConcept::create(['name' => 'Incentives']);
        PayrollAdditionalConcept::create(['name' => 'Medical Licenses']);
        PayrollAdditionalConcept::create(['name' => 'Pending From Previous Payroll']);
        PayrollAdditionalConcept::create(['name' => 'Representation Expenses']);
        PayrollAdditionalConcept::create(['name' => 'Weeding']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payroll_additional_concepts');
    }
}
