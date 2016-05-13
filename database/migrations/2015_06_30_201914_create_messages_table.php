<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username_from')->index();
			$table->string('username_to')->index();
			$table->string('message');
			$table->timestamps();


			$table->foreign('username_from')->references('username')->on('users')
				->onDelete('cascade')->onUpdate('cascade');

			$table->foreign('username_to')->references('username')->on('users')
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
		Schema::drop('messages');
	}

}
