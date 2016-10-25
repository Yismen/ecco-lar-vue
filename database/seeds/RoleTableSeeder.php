<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Role::truncate();

        Role::create([[
                'id' => 1,
                'name' => 'admin', 
                'display_name' => 'System Administrator', 
                'description' => 'Application super user. Users with this role has no restriction.'
            ],
                ['id' => 2,
                'name' => 'owner', 
                'display_name' => 'Application Owner', 
                'description' => 'Application owner. Just litle restriction.'
            ]
        ]);

        Model::reguard();
    }
}
