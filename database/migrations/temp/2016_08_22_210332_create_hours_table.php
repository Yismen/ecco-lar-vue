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
            $table->double('total_hours', 5, 2)->default(0.00);
			$table->integer('type_id')->unsigned()->index();
			$table->timestamps();

			$table->foreign('type_id')->references('id')->on('type_of_hours');
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
