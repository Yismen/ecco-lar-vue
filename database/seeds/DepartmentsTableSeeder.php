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
        Department::create(['name' => 'Comcast']);
        Department::create(['name' => 'Publishing']);
        Department::create(['name' => 'Banca']);
        Department::create(['name' => 'Blackhawk DE']);
        Department::create(['name' => 'Blackhawk CS']);
        Department::create(['name' => 'ATT']);
        Department::create(['name' => 'TMC - Energy']);
    }
}
