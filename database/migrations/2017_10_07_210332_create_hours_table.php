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
			$table->integer('employee_id')->unsigned()->index();
			$table->foreign('employee_id')->references('id')->on('employees');
            $table->string('unique_id', 30);
			$table->string('name', 300);
			$table->date('date');
            $table->double('regulars', 5, 5)->default(0.00);
            $table->double('nightly', 5, 5)->default(0.00);
            $table->double('holidays', 5, 5)->default(0.00);
            $table->double('training', 5, 5)->default(0.00);
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
		Schema::drop('hours');
	}

}
