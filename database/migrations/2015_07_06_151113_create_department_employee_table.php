<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentEmployeeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('department_employee', function(Blueprint $table)
		{
			// $table->increments('id');
			$table->integer('employee_id')->unsigned()->index();
			$table->integer('department_id')->unsigned()->index();

			$table->foreign('employee_id')->references('id')->on('employees')
				->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('department_id')->references('id')->on('departments')
				->onDelete('cascade')->onUpdate('cascade');

			// $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('department_employee');
	}

}
