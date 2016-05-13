<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees', function(Blueprint $table ){
			$table->increments('id');
			// $table->string('punch_id', 15);
			// $table->string('card_id', 15);
			// $table->string('employee_id', 5);
			// $table->string('username', 30);
			$table->string('first_name', 50);
			$table->string('last_name', 50);
			$table->dateTime('hire_date');
			$table->string('personal_id', 15)->unique();
			$table->dateTime('date_of_birth');
			$table->string('cellphone_number', 25);
			$table->string('secondary_phone', 25);
			$table->tinyInteger('supervisor_id')->unsigned()->index();
			$table->tinyInteger('gender_id')->unsigned()->index();
			$table->tinyInteger('marital_id')->unsigned()->index();
			$table->string('has_kids', 10)->default(0);
			$table->tinyInteger('position_id')->unsigned()->index();
			$table->tinyInteger('department_id')->unsigned()->index();
			// $table->integer('salary_id')->unsigned()->index();
			$table->string('photo', 80);

			$table->timestamps();

			$table->foreign('gender_id')->references('id')->on('genders')
				->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('marital_id')->references('id')->on('civil_status')
				->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('position_id')->references('id')->on('positions')
				->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');

		});

		/**
		 * set the initial value for the autoincrement field
		 */
		DB::statement('ALTER TABLE `employees` AUTO_INCREMENT = 50001');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('employees');
	}

}
