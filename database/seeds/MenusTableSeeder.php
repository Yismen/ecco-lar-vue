<?php

use App\Menu;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Menu::create(['name' => 'telescope', 'display_name' => 'Telescope', 'description' => '', 'icon' => 'fa fa-bolt']);
        Menu::create(['name' => 'horizon', 'display_name' => 'Horizon', 'description' => '', 'icon' => 'fa fa-gears']);
        Menu::create(['name' => 'admin/users', 'display_name' => 'Users', 'description' => '', 'icon' => 'fa fa-users']);
        Menu::create(['name' => 'admin/roles', 'display_name' => 'Roles', 'description' => '', 'icon' => 'fa fa-unlock']);
        Menu::create(['name' => 'admin/permissions', 'display_name' => 'Permissions', 'description' => '', 'icon' => 'fa fa-key']);
        Menu::create(['name' => 'admin/menus', 'display_name' => 'Menus', 'description' => '', 'icon' => 'fa fa-bars']);
        Menu::create(['name' => 'admin/employees', 'display_name' => 'Employees', 'description' => '', 'icon' => 'fa fa-users']);
        Menu::create(['name' => 'admin/positions', 'display_name' => 'Positions', 'description' => '']);
    }
}
