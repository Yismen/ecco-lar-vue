<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('productions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('insert_date');
			// $table->integer('year')->unsigned();
			// $table->integer('month')->unsigned();
			// $table->integer('week')->unsigned();
			$table->integer('employee_id')->unsigned()->index();
			$table->string('name', 120);
			$table->dateTime('in_time');
			$table->double('production_hours', 15, 4)->unsigned();
			$table->integer('break_time')->unsigned();
            $table->double('downtime', 15, 4)->unsigned()->default(0);
            $table->dateTime('out_time');
			$table->integer('production')->unsigned();

            $table->integer('reason_id')->unsigned()->nullable()->index();
			$table->integer('client_id')->unsigned()->index();
			$table->integer('source_id')->unsigned()->index();

            $table->string('unique_id')->unique();
			
			$table->foreign('reason_id')->references('id')->on('reasons');
			$table->foreign('employee_id')->references('id')->on('employees');
			$table->foreign('client_id')->references('id')->on('clients');
			$table->foreign('source_id')->references('id')->on('sources');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('productions');
	}

}
