<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDowntimesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('downtimes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employee_id')->unsigned()->index();
			$table->dateTime('insert_date');
			$table->integer('year')->unsigned();
			$table->integer('month')->unsigned();
			$table->integer('week')->unsigned();
			$table->dateTime('from_time');
			$table->dateTime('to_time');
			$table->integer('break_time')->unsigned();
			$table->integer('total_hours')->unsigned();
			$table->integer('reason_id')->unsigned()->index();
            $table->string('unique_id')->unique();
			
			$table->timestamps();

			$table->foreign('employee_id')->references('id')->on('employees')
				->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('reason_id')->references('id')->on('reasons')
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
		Schema::drop('downtimes');
	}

}
