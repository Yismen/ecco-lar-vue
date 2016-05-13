<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('site_messages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('customer_name', 80);
			$table->string('phone', 20);
			$table->string('email', 80);
			$table->integer('contact_types_id')->unsigned()->index();
			$table->string('message', 800);
			$table->string('answer', 80)->nullable();
			$table->timestamps();

			$table->foreign('contact_types_id')->references('id')
				->on('contact_types')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('site_messages');
	}

}
