<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('payment_type', 100);
			$table->timestamps();
		});

		factory(App\Payment::class)->create(['id'=>1, 'payment_type'=>'Hourly']);
		factory(App\Payment::class)->create(['id'=>2, 'payment_type'=>'Weekly']);
		factory(App\Payment::class)->create(['id'=>3, 'payment_type'=>'By-Weekly']);
		factory(App\Payment::class)->create(['id'=>4, 'payment_type'=>'Monthly']);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payments');
	}

}
