<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('route_user', function(Blueprint $table){		
			$table->integer('user_id')->index()->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');	

			$table->integer('route_id')->index()->unsigned();		
			$table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
				
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
		Schema::drop('route_user'); 
	}

}
