<?php

use App\Marital;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MaritalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Marital::truncate();
        Marital::create(['id'=>1,'name'=>'Married']);
        Marital::create(['id'=>2,'name'=>'Single']);
        Marital::create(['id'=>3,'name'=>'Common Law']);
    }
}
