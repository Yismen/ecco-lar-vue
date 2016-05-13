<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::create('contacts', function(Blueprint $table)
		{
			
			$table->increments('id');	
			$table->string('username', 80);
			$table->string('name', 80);
			$table->string('main_phone', 80);
			$table->string('works_at', 80)->nullable();
			$table->string('position', 80)->nullable();
			$table->string('secondary_phone', 20)->nullable();
			$table->string('email', 80)->nullable();
			$table->tinyInteger('public')->default(0)->unsigned();	
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
		Schema::drop('contacts');
	}

}
