<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $this->setAutoIncrementStartNumber(10000);

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

    private function setAutoIncrementStartNumber($number = 10000)
    {
        switch (config('database.default')) {
            case 'pgsql':
                DB::statement('ALTER SEQUENCE employees_id_seq RESTART WITH ' . $number);
                break;

            default:
                DB::statement('ALTER TABLE `employees` AUTO_INCREMENT = ' . $number);
                break;
    }
}
