<?php

use Illuminate\Database\Seeder;
use App\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hhrrRole = Role::create(['name' => 'human_resource', 'display_name' => 'Recursos Humanos']);

        Menu::create(['name' => 'users', 'display_name' => 'Users', 'description' => '']);
        Menu::create(['name' => 'roles', 'display_name' => 'Roles', 'description' => '']);
        Menu::create(['name' => 'permissions', 'display_name' => 'Permissions', 'description' => '']);

        Menu::create(['name' => 'employees', 'display_name' => 'Empleados', 'description' => '']);
        Menu::create(['name' => 'banks', 'display_name' => 'Banks', 'description' => '']);
    }
}
