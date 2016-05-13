<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hours', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamp('time_in');
			$table->timestamp('time_out');
			$table->integer('break_time')->unsigned();
			$table->integer('type_id');
			$table->timestamps();

			$table->foreign('type_id')->references('id')->on('type_of_hours')
				->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hours');
	}

}
