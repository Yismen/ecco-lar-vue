<?php

use App\PaymentType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('slug', 150)->nullable();
            $table->timestamps();
        });

        $this->seedPaymentType();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payment_types');
    }

    public function seedPaymentType()
    {
        PaymentType::create([
            'name' => 'By Hours',
            'slug' => 'by-hours',
        ]);

        PaymentType::create([
            'name' => 'Salary',
            'slug' => 'salary',
        ]);

        PaymentType::create([
            'name' => 'By Sales',
            'slug' => 'by-sales',
        ]);
    }
}
