<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\TypeOfHour;

class CreateTypeOfHoursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('type_of_hours', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type', 100);
			$table->string('Display Name', 100);
			$table->timestamps();
		});

		TypeOfHour::create(['type' => 'regular', 'display_name' => 'Regular']); 
		TypeOfHour::create(['type' => 'overtime', 'display_name' => 'Overtime']); 
		TypeOfHour::create(['type' => 'nightly', 'display_name' => 'Nightly']); 
		TypeOfHour::create(['type' => 'holidays_off', 'display_name' => 'Holidays and Days Off']); 
		TypeOfHour::create(['type' => 'regular', 'display_name' => 'Training']); 

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('type_of_hours');
	}

}
