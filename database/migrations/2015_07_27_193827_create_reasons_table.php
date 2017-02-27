<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReasonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reasons', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('reason', 100);
			$table->timestamps();
		});

		factory(App\Reason::class)->create(['id'=>1, 'reason'=>'System Down']);
		factory(App\Reason::class)->create(['id'=>2, 'reason'=>'Login Locked']);
		factory(App\Reason::class)->create(['id'=>3, 'reason'=>'Lack of Work']);
		factory(App\Reason::class)->create(['id'=>4, 'reason'=>'Training']);
		factory(App\Reason::class)->create(['id'=>5, 'reason'=>'Coaching and feedback']);
		factory(App\Reason::class)->create(['id'=>6, 'reason'=>'Position broken']);
		factory(App\Reason::class)->create(['id'=>7, 'reason'=>'Internet outage']);
		factory(App\Reason::class)->create(['id'=>8, 'reason'=>'Energy outage']);
		factory(App\Reason::class)->create(['id'=>9, 'reason'=>'Hold Pending']);
		factory(App\Reason::class)->create(['id'=>10, 'reason'=>'Corrections']);
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reasons');
	}

}
