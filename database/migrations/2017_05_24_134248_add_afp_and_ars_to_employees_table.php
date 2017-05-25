<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAfpAndArsToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->integer('ars_id')->unsigned()->nullable()->after('supervisor_id');
            $table->foreign('ars_id')->references('id')->on('ars');
            $table->integer('afp_id')->unsigned()->nullable()->after('supervisor_id');
            $table->foreign('afp_id')->references('id')->on('afps');
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
            $table->dropForeign('employees_ars_id_foreign');
            // $table->dropColumn('ars_id');
            $table->dropForeign('employees_afp_id_foreign');
            // $table->dropColumn('afp_id');
        });
    }
}
