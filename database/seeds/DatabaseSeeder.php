<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(RevenueTypesTableSeeder::class);
        $this->call(TerminationTypesTableSeeder::class);
        $this->call(TerminationReasonsTableSeeder::class);
        $this->call(SitesTableSeeder::class);
        $this->call(SourcesTableSeeder::class);

        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Model::reguard();
    }
}
