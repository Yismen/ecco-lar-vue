<?php

use App\PayrollDiscountConcept;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollDiscountConceptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_discount_concepts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->timestamps();
        });

        PayrollDiscountConcept::create(['name' => 'Afp']);
        PayrollDiscountConcept::create(['name' => 'Ars']);
        PayrollDiscountConcept::create(['name' => 'Other']);
        PayrollDiscountConcept::create(['name' => 'Caffeteria']);
        PayrollDiscountConcept::create(['name' => 'Card']);
        PayrollDiscountConcept::create(['name' => 'Loan']);
        PayrollDiscountConcept::create(['name' => 'Uniforms']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payroll_discount_concepts');
    }
}
