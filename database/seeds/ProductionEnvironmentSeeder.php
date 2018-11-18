<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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

        $this->seedUsersTable()
            ->seedRolesTable();

        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Model::reguard();
    }

    protected function seedUsersTable()
    {
        // User::truncate();
        $user = User::where('email', 'yismen.jorge@gmail.com')->first();

        if ($user) {
            $user->delete();
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

    protected function seedRolesTable()
    {
        // Role::truncate();

        if ($role1 = Role::find(1)) {
            $role1->delete();
        }
        if ($role2 = Role::find(2)) {
            $role2->delete();
        }

        $roleAdmin = Role::create([ 'name' => 'admin', ]);
        $roleOwner = Role::create([ 'name' => 'owner', ]);
        $hhrrRole = Role::create(['name' => 'human_resource']);

        $user = User::where('email', 'yismen.jorge@gmail.com')->first();

        $user->roles()->sync([$roleAdmin->id, $roleOwner->id, $hhrrRole->id]);

        $usersMenu = Menu::create(['name' => 'admin/users', 'display_name' => 'Users', 'description' => '']);
        $rolesMenu = Menu::create(['name' => 'admin/oles', 'display_name' => 'Roles', 'description' => '']);
        $permissionsMenu = Menu::create(['name' => 'admin/permissions', 'display_name' => 'Permissions', 'description' => '']);
        $menusMenu = Menu::create(['name' => 'admin/menus', 'display_name' => 'Menus', 'description' => '']);
        $telescope = Menu::create(['name' => 'telescope', 'display_name' => 'Telescope', 'description' => '']);

        $role = Role::where('name', 'admin')->first()->menus()->sync([
            $usersMenu->id,
            $rolesMenu->id,
            $permissionsMenu->id,
            $menusMenu->id,
            $telescope->id,
        ]);
    }
}
