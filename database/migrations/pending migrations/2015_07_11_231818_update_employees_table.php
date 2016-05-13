<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEmployeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('employees', function(Blueprint $table)
		{
			$table->foreign('gender_id')->references('id')->on('genders')
				->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('civil_status_id')->references('id')->on('civil_status')
				->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('position_id')->references('id')->on('positions')
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
	}

}
