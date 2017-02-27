<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGendersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('genders', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->string('gender', 30)->unique();
		    $table->timestamps();
		});

		factory(App\Gender::class)->create([
			'id'=>1,
			'gender'=>'Male'
		]);
		factory(App\Gender::class)->create([
			'id'=>2,
			'gender'=>'Female'
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('genders');
	}

}
