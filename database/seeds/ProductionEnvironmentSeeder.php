<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Menu;

class ProductionEnvironmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        //disable foreign key check for this connection before running seeders
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->users()
            ->roles()
            ->menus();

        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Model::reguard();
    }

    protected function users()
    {
        // User::truncate();
        switch (config('database.default')) {
            case 'pgsql':
                DB::statement('ALTER SEQUENCE employees_id_seq RESTART WITH 10000');
                break;

            default:
                DB::statement('ALTER TABLE `employees` AUTO_INCREMENT = 10000');
                break;
        }

        factory(App\User::class)->create([
            'name' => 'Yismen Jorge', // $faker->name,
            'email' => 'yismen.jorge@gmail.com', // $faker->email,
            'username' => 'yjorge', // $faker->name,
            'password' => bcrypt('secret'), // bcrypt(str_random(10)),
            'remember_token' => str_random(10),
            'is_active' => 1,
            'is_admin' => 1,
        ]);
        return $this;
    }

    private function roles()
    {
        if ($role1 = Role::find(1)) {
            $role1->delete();
        }
        if ($role2 = Role::find(2)) {
            $role2->delete();
        }

        $user = User::where('email', 'yismen.jorge@gmail.com')->first();
        $admin = Role::create([ 'name' => 'admin', ]);
        $user->roles()->sync((array)$admin->only('id'));
        Role::create([ 'name' => 'owner', ]);
        Role::create(['name' => 'human_resource']);
        Role::create(['name' => 'hhrr_assistant']);

        return $this;
    }

    private function menus()
    {
        Menu::create(['name' => 'telescope', 'display_name' => 'Telescope', 'description' => '']);
        Menu::create(['name' => 'admin/users', 'display_name' => 'Users', 'description' => '']);
        Menu::create(['name' => 'admin/roles', 'display_name' => 'Roles', 'description' => '']);
        Menu::create(['name' => 'admin/permissions', 'display_name' => 'Permissions', 'description' => '']);
        Menu::create(['name' => 'admin/menus', 'display_name' => 'Menus', 'description' => '']);
        Menu::create(['name' => 'admin/employees', 'display_name' => 'Employees', 'description' => '']);
        Menu::create(['name' => 'admin/positions', 'display_name' => 'Positions', 'description' => '']);

        return $this;
    }
}
