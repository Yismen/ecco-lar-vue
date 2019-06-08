<?php

use App\TerminationReason;
use Illuminate\Database\Seeder;

class TerminationReasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TerminationReason::create([
            'reason' => 'Found Better Job',
        ]);
        TerminationReason::create([
            'reason' => 'Not enough salary',
        ]);
        TerminationReason::create([
            'reason' => 'High Absentism',
        ]);
        TerminationReason::create([
            'reason' => 'Low Performance',
        ]);
        TerminationReason::create([
            'reason' => 'Other',
        ]);
    }
}
