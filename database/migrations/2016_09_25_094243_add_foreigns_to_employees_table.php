<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {

            $table->integer('position_id')->unsigned()->nullable()->index();

            // $table->foreign('gender_id')->references('id')->on('genders');
            // $table->foreign('marital_id')->references('id')->on('civil_status');
            // $table->foreign('position_id')->references('id')->on('positions');

            // $table->foreign('supervisor_id')->references('id')->on('supervisors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
           // $table->dropForeign('gender_id');
           // $table->dropForeign('marital_id');
           // $table->dropForeign('position_id');
           // $table->dropForeign('supervisor_id');
        });
    }
}
