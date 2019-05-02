<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Yismen Jorge', // $faker->name,
            'email' => 'yismen.jorge@gmail.com', // $faker->email,
            'username' => 'yjorge', // $faker->name,
            'password' => bcrypt('secret'), // bcrypt(str_random(10)),
            'remember_token' => str_random(10),
            'is_active' => 1,
            'is_admin' => 1,
        ]);
    }
}
