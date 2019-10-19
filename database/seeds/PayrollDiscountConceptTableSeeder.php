<?php

use App\PayrollDiscountConcept;
use Illuminate\Database\Seeder;

class PayrollDiscountConceptTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        PayrollDiscountConcept::create(['name' => 'Afp']);
        PayrollDiscountConcept::create(['name' => 'Ars']);
        PayrollDiscountConcept::create(['name' => 'Other']);
        PayrollDiscountConcept::create(['name' => 'Caffeteria']);
        PayrollDiscountConcept::create(['name' => 'Card']);
        PayrollDiscountConcept::create(['name' => 'Loan']);
        PayrollDiscountConcept::create(['name' => 'Uniforms']);
    }
}
