<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Schema::create('todos', function(Blueprint $table)
		// {
		//     $table->increments('id');
		//     $table->string('todo', 150);
		// 	$table->text('description');
		// 	$table->dateTime('dued_at');
		// 	$table->string('priority', 25);
		// 	$table->tinyInteger('completed')->default(0)->unsigned();
		// });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('todos')
	}

}
