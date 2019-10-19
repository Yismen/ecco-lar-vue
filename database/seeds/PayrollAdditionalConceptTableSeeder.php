<?php

use App\PayrollAdditionalConcept;
use Illuminate\Database\Seeder;

class PayrollAdditionalConceptTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PayrollAdditionalConcept::create(['name' => 'Bonus']);
        PayrollAdditionalConcept::create(['name' => 'Dead in the Family']);
        PayrollAdditionalConcept::create(['name' => 'Incentives']);
        PayrollAdditionalConcept::create(['name' => 'Medical Licenses']);
        PayrollAdditionalConcept::create(['name' => 'Pending From Previous Payroll']);
        PayrollAdditionalConcept::create(['name' => 'Representation Expenses']);
        PayrollAdditionalConcept::create(['name' => 'Weeding']);
    }
}
