<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeGenderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employee_gender', function(Blueprint $table)
		{
			$table->integer('employee_id')->unsigned()->index();
			$table->integer('gender_id')->unsigned()->index();

			$table->foreign('employee_id')->references('id')->on('employees')
				->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('gender_id')->references('id')->on('genders')
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
		Schema::drop('employee_gender');
	}

}
