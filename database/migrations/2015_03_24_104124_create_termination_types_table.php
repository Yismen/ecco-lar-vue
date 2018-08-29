<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerminationTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('termination_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('description');
			$table->timestamps();
		});

		factory(App\TerminationType::class)->create([
			'name' => 'Resigned',
			'description' => 'The person communicated his desire to terminate the contract',
		]);
		factory(App\TerminationType::class)->create([
			'name' => 'Terminated',
			'description' => 'The company has excercised the termination of the contract',
		]);
		factory(App\TerminationType::class)->create([
			'name' => 'Fired',
			'description' => 'The employee commited a heavy fault, causing his termination',
		]);
		factory(App\TerminationType::class)->create([
			'name' => 'Abandon',
			'description' => 'Multiple No Show No Call',
		]);
		factory(App\TerminationType::class)->create([
			'name' => 'Dismiss',
			'description' => 'The person sued the company',
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('termination_types');
	}

}
