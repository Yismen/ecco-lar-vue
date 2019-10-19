<?php

use App\PaymentFrequency;
use Illuminate\Database\Seeder;

class PaymentFrequencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentFrequency::create([
            'name' => 'Bi Weekly',
            'slug' => 'bi-weekly',
        ]);

        PaymentFrequency::create([
            'name' => 'Monthly',
            'slug' => 'Monthly',
        ]);

        PaymentFrequency::create([
            'name' => 'Daily',
            'slug' => 'daily',
        ]);

        PaymentFrequency::create([
            'name' => 'Weekly',
            'slug' => 'weekly',
        ]);
    }
}
