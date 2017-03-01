<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Curve;

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

		Curve::create(['days_in_production_limit' => 30, 'goal_percentage_required' => 0.7]);
		Curve::create(['days_in_production_limit' => 45, 'goal_percentage_required' => 0.8]);
		Curve::create(['days_in_production_limit' => 60, 'goal_percentage_required' => 0.9]);
		Curve::create(['days_in_production_limit' => 70, 'goal_percentage_required' => 1]);
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
