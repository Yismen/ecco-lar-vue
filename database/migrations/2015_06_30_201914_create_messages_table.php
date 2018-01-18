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
			$table->string('user_id_from')->index();
			$table->string('user_id_to')->index();
			$table->string('message');
			$table->timestamps();


			$table->foreign('user_id_from')->references('id')->on('users')
				->onDelete('cascade')->onUpdate('cascade');

			$table->foreign('user_id_to')->references('id')->on('users')
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
