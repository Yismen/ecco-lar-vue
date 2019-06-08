<?php

use App\TerminationType;
use Illuminate\Database\Seeder;

class TerminationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TerminationType::create([
            'name' => 'Resigned (Renuncia)',
            'description' => 'The person communicated his desire to terminate the contract',
        ]);
        TerminationType::create([
            'name' => 'Terminated (Desahucio)',
            'description' => 'The company has excercised the termination of the contract',
        ]);
        TerminationType::create([
            'name' => 'Fired (Despido Justificado)',
            'description' => 'The employee commited a heavy fault, causing his termination',
        ]);
        TerminationType::create([
            'name' => 'Abandon (Abandono)',
            'description' => 'Multiple No Show No Call',
        ]);
        TerminationType::create([
            'name' => 'Dismiss (Dimision)',
            'description' => 'The person sued the company',
        ]);
    }
}
