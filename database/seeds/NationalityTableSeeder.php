<?php

use App\Nationality;
use Illuminate\Database\Seeder;

class NationalityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Nationality::create(['name' => 'Dominicano']);
        Nationality::create(['name' => 'Hatiano']);
        Nationality::create(['name' => 'Venezolano']);
        Nationality::create(['name' => 'Estadounidense']);
        Nationality::create(['name' => 'Puertoriqueno']);
        Nationality::create(['name' => 'Mexicano']);
        Nationality::create(['name' => 'Israeli']);
        Nationality::create(['name' => 'Argentino']);
    }
}
