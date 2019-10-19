<?php

use App\Marital;
use Illuminate\Database\Seeder;

class MaritalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Marital::create(['id' => 1, 'name' => 'Married']);
        Marital::create(['id' => 2, 'name' => 'Single']);
    }
}
