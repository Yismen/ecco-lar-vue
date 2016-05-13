<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePunchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('punches', function(Blueprint $table)
		{
			$table->increments('id');			
			$table->integer('employee_id')->unsigned()->unique()->index();
			$table->string('punch', 100);
			$table->timestamps();

			$table->foreign('employee_id')->references('id')->on('employees')
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
		Schema::drop('punches');
	}

}
