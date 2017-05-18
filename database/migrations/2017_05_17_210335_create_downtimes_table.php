<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDowntimesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('downtimes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('date')->default(new DateTime());
			$table->integer('employee_id')->unsigned()->index();
			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
			$table->string('name', 200);
			$table->double('hours', 2, 2)->unsigned();
			$table->integer('reason_id')->unsigned()->index();
			$table->foreign('reason_id')->references('id')->on('reasons')->onDelete('cascade');
			$table->integer('type_id')->unsigned();
			$table->foreign('type_id')->references('id')->on('hours_types')->onDelete('cascade');
            $table->string('unique_id', 30)->nullable()->unique();
			
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
		Schema::drop('downtimes');
	}

}
