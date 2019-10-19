<?php

use App\Gender;
use Illuminate\Database\Seeder;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gender::create(['id' => 1, 'name' => 'Male']);
        Gender::create(['id' => 2, 'name' => 'Female']);
    }
}
