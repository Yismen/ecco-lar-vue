<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsAdditionalLineToEscalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escal_records', function (Blueprint $table) {            
            $table->boolean('is_additional_line')->default(false)->after('is_bbb');            
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
            $table->dropColumn('is_additional_line');            
        });
    }
}
