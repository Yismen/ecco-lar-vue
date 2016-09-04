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
			$table->date('insert_date');
			$table->integer('employee_id')->unsigned()->index();
			$table->string('name', 200);
			$table->integer('year')->unsigned();
			$table->integer('month')->unsigned();
			$table->integer('week')->unsigned();
			$table->time('from_time');
			$table->time('to_time');
			$table->integer('break_time')->unsigned();
			$table->double('total_hours', 2, 2)->unsigned();
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
