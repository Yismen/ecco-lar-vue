<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        $user = User::where('email', 'yismen.jorge@gmail.com')->first();
        $admin = Role::create([ 'name' => 'admin', ]);
        $user->roles()->sync((array)$admin->only('id'));


        Role::create(['name' => 'management']);
        Role::create(['name' => 'human_resource']);
        Role::create(['name' => 'floor_manager']);
        Role::create(['name' => 'supervisor']);
        Role::create(['name' => 'auditor']);
        Role::create(['name' => 'agent']);
        Role::create(['name' => 'hhrr_assistant']);
    }
}
