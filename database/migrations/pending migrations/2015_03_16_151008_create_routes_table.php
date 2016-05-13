<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('routes', function (Blueprint $table){
			$table->increments('id');
			$table->string('route', 80)->unique();
			$table->string('route_label', 80)->unique();
			$table->string('route_icon', 80)->nullable();
			$table->string('resource', 80);
			// $table->string('resource_label', 80);
			$table->string('resource_icon', 80)->nullable();
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
		Schema::drop('routes');
	}

}
