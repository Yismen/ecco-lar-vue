<?php

use App\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create(['name' => 'Administration']);
        Department::create(['name' => 'Banca']);
        Department::create(['name' => 'Staff']);
        Department::create(['name' => 'Production']);
    }
}
