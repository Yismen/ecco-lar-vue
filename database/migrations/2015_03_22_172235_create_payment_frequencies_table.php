<?php

use App\PaymentFrequency;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentFrequenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_frequencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('slug', 150)->nullable();
            $table->timestamps();
        });

        $this->seedPaymentFrequency();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payment_frequencies');
    }

    public function seedPaymentFrequency()
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
