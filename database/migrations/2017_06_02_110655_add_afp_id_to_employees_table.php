<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAfpIdToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->integer('afp_id')->unsigned()->nullable()->after('supervisor_id');
            // $table->foreign('afp_id')->references('id')->on('afps');
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
            // $table->dropForeign(['afp_id']);
            $table->dropColumn('afp_id');
        });
    }
}
