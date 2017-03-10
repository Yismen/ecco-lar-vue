<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsBbbToEscalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escal_records', function (Blueprint $table) {
            $table->boolean('is_bbb')->nullable()->default(false)->after('escal_client_id');
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
            $table->dropColumn('is_bbb');
        });
    }
}
