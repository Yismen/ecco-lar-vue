<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpsalesAndCcsalesFieldsToPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('performances', function (Blueprint $table) {
            $table->integer('upsales')->unsigned()->default(0)->after('transactions');
            $table->integer('cc_sales')->unsigned()->default(0)->after('upsales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('performances', 'upsales')) {
            Schema::table('performances', function (Blueprint $table) {
                $table->dropColumn('upsales');
            });
        }
        
        if (Schema::hasColumn('performances', 'cc_sales')) {
            Schema::table('performances', function (Blueprint $table) {
                $table->dropColumn('cc_sales');
            });
        }
        
    }
}
