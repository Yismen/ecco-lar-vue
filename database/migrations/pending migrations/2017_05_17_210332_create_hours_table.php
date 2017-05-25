<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hours', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employee_id')->unsigned()->index();
			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
			$table->string('name', 300);
			$table->date('date')->nullable()->default(new DateTime());
            $table->double('regulars', 5, 2)->default(0.00);
            $table->double('overtime', 5, 2)->default(0.00);
            $table->double('nightly', 5, 2)->default(0.00);
            $table->double('holidays', 5, 2)->default(0.00);
            $table->double('training', 5, 2)->default(0.00);
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
		Schema::drop('hours');
	}

}
