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
        Model::unguard();

        // Marital::truncate();

        factory(Marital::class)->make();

        Model::reguard();
    }
}
