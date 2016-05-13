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
			$table->timestamp('insert_date');
			$table->integer('employee_id')->unsigned()->index();
			$table->string('name', 120);
			$table->double('production_hours', 15, 4)->unsigned();
			$table->integer('production')->unsigned();
			$table->string('client', 100);
			$table->string('source', 100);

			$table->foreign('employee_id')->references('id')->on('employees');
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
