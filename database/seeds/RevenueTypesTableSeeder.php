<?php

use Illuminate\Database\Seeder;
use App\RevenueType;

class RevenueTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RevenueType::create(['name' => 'Sales or Production']);
        RevenueType::create(['name' => 'Login Time']);
        RevenueType::create(['name' => 'Talk Time']);
    }
}
