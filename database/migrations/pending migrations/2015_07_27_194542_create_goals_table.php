<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('goals', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('client_id')->unsigned()->index();
			$table->double('goal', 15, 2);
			$table->timestamps();

			$table->foreign('client_id')->references('id')->on('clients')
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
		Schema::drop('goals');
	}

}
