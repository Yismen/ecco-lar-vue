<?php

use App\Role;
use App\User;
use App\Profile;
use App\Gender;
use App\Marital;
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
            ->seedRolesTable()
            ;

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

        $roleAdmin = Role::create([
            'name' => 'admin',
            'display_name' => 'System Administrator',
            'description' => 'Application super user. Users with this role has no restriction.'
        ]);
        $roleOwner = Role::create([
            'name' => 'owner',
            'display_name' => 'Application Owner',
            'description' => 'Application owner. Little restriction. Just to differentiate from the system admin.'
        ]);

        $user = User::where('email', 'yismen.jorge@gmail.com')->first();

        $user->roles()->sync([$roleAdmin->id, $roleOwner->id]);

        return $this;
    }
}
