<?php

use App\Project;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create(['name' => 'Comcast']);
        Project::create(['name' => 'Publishing']);
        Project::create(['name' => 'Banca']);
        Project::create(['name' => 'Blackhawk DE']);
        Project::create(['name' => 'Blackhawk CS']);
        Project::create(['name' => 'ATT']);
        Project::create(['name' => 'TMC - Energy']);
    }
}
