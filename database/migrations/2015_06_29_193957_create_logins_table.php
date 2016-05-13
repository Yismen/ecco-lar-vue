<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logins', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('login');
			$table->integer('employee_id')->unsigned()->index();
			$table->integer('system_id')->unsigned()->index();
			$table->timestamps();

			$table->foreign('employee_id')->references('id')->on('employees')
				->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('system_id')->references('id')->on('systems')
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
		Schema::drop('logins');
	}

}
