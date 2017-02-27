<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerminationReasonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('termination_reasons', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('reason');
			$table->string('description');
			$table->timestamps();
		});

		factory(App\TerminationReason::class)->create([
			'id'=>1,
			'reason'=>'Found Better Job',
		]);
		factory(App\TerminationReason::class)->create([
			'id'=>2,
			'reason'=>'Not enough salary',
		]);
		factory(App\TerminationReason::class)->create([
			'id'=>3,
			'reason'=>'High Absentism',
		]);
		factory(App\TerminationReason::class)->create([
			'id'=>4,
			'reason'=>'Low Performanc',
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('termination_reasons');
	}

}
