<?php

use App\Role;
use App\User;
use App\Gender;
use App\Marital;
use Illuminate\Database\Seeder;

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

        $this->seedUsersTable()
            ->seedGendersTable()
            ->seedMaritalsTable() 
            ->seedRolesTable();

        Model::reguard();   
    }

    protected function seedUsersTable(User $user)
    {
        $user->create([
            'name' => 'Yismen Jorge', // $faker->name,
            'email' => 'yismen.jorge@gmail.com', // $faker->email,
            'password' => bcrypt('password'), // bcrypt(str_random(10)),
            'remember_token' => str_random(10),
            // 'is_active ' => 1,
            // 'is_admin ' => 1,
        ]);

        return $this;
    }

    protected function seedRolesTable(Role $role)
    {
        $role->create([
            'id' => 1,
            'name' => 'admin', 
            'display_name' => 'System Administrator', 
            'description' => 'Application super user. Users with this role has no restriction.'
        ]);
        $role->create([
            'id' => 2,
            'name' => 'owner', 
            'display_name' => 'Application Owner', 
            'description' => 'Application owner. Little restriction. Just to differentiate from the system admin.'
        ]);

        $user = User::find(1);

        $user->roles()->sync([1,2]);

        return $this;
    }

    protected function seedMaritalsTable(Marital $model)
    {
        $model->truncate();        

        $model->create(['id'=>1,'name'=>'Married']);
        $model->create(['id'=>2,'name'=>'Single']);
        $model->create(['id'=>3,'name'=>'Common Law']);

        return $this;   
    }

    protected function seedGendersTable(Gender $model)
    {
        $limit = 3;
        $model->truncate(); 
        
        $model->create(['id'=>1,'gender'=>'Male']);
        $model->create(['id'=>2,'gender'=>'Female']);

        return $this;   
    }
}
