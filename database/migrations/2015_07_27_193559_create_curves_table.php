<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurvesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('curves', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('days_in_production_limit');
			// $table->integer('goal_percentage_required');
			$table->float('goal_percentage_required');
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
		Schema::drop('curves');
	}

}
