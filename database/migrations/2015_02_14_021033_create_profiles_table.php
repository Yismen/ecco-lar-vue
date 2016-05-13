<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function(Blueprint $table)
		{
			
			$table->increments('id');	
			$table->string('username', 80)->index();
			$table->string('phone', 80);
			$table->string('bio', 1200)->nullable();	
			$table->string('photo', 1200)->nullable();	
			$table->timestamps();

			$table->foreign('username')->references('username')
				->on('users')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('profiles');
	}

}
