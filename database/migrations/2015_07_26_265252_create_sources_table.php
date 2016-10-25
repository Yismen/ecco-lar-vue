<?php

use App\Source;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSourcesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sources', function(Blueprint $table)
		{	
			$table->increments('id');
			$table->string('name', 100)->unique();
			$table->timestamps();
		});

		Source::create([
			'id'=>1,
			'name'=>'Data Entry',
			]);

		Source::create([
			'id'=>2,
			'name'=>'Resubs-VzW',
			]);

		Source::create([
			'id'=>3,
			'name'=>'Resubs-General',
			]);

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sources');
	}

}
