<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('positions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->integer('department_id')->unsigned()->index();
		    $table->integer('payment_id')->unsigned()->index();
		    $table->double('salary', 15, 2);
			$table->timestamps();

			// $table->foreign('department_id')->references('id')->on('departments')
				// ->onDelete('cascade')->onUpdate('cascade');

			// $table->foreign('payment_id')->references('id')->on('payments')
			// 	->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('positions');
	}

}
