<?php

use App\Site;
use Illuminate\Database\Seeder;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Site::create(['name' => 'Santiago - Head Quarter']);
        Site::create(['name' => 'Florida']);
    }
}
