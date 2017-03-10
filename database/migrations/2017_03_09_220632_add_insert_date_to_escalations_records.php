<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInsertDateToEscalationsRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escal_records', function (Blueprint $table) {
            $table->date('insert_date')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('escal_records', function (Blueprint $table) {
            $table->dropColumn('insert_date');
        });
    }
}
