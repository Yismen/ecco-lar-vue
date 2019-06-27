<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDowntimeReasonAndReportedByToPerformances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('performances', function (Blueprint $table) {
            $table->integer('downtime_reason_id')->unsigned()->nullable()->after('revenue');
            $table->string('reported_by', 100)->nullable()->after('downtime_reason_id');

            $table->foreign('downtime_reason_id')->references('id')->on('downtime_reasons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('performances', function (Blueprint $table) {
            $table->dropForeign(['downtime_reason_id']);

            $table->dropColumn(['downtime_reason_id', 'reported_by']);
        });
    }
}
