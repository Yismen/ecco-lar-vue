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
        Menu::truncate();

        Menu::create(['name' => 'telescope', 'display_name' => 'Telescope', 'description' => '']);
        Menu::create(['name' => 'admin/users', 'display_name' => 'Users', 'description' => '']);
        Menu::create(['name' => 'admin/roles', 'display_name' => 'Roles', 'description' => '']);
        Menu::create(['name' => 'admin/permissions', 'display_name' => 'Permissions', 'description' => '']);
        Menu::create(['name' => 'admin/menus', 'display_name' => 'Menus', 'description' => '']);
        Menu::create(['name' => 'admin/employees', 'display_name' => 'Employees', 'description' => '']);
        Menu::create(['name' => 'admin/positions', 'display_name' => 'Positions', 'description' => '']);
    }
}
