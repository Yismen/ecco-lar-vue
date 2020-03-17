<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimeColumnsToPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('performances', function (Blueprint $table) {
            $table->double('pending_dispo_time', 15, 8)->unsigned()->default(0)->after('talk_time');
            $table->double('off_hook_time', 15, 8)->unsigned()->default(0)->after('talk_time');
            $table->double('away_time', 15, 8)->unsigned()->default(0)->after('talk_time');
            $table->double('training_time', 15, 8)->unsigned()->default(0)->after('talk_time');
            $table->double('lunch_time', 15, 8)->unsigned()->default(0)->after('talk_time');
            $table->double('break_time', 15, 8)->unsigned()->default(0)->after('talk_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('performances', 'pending_dispo_time')) {
            Schema::table('performances', function (Blueprint $table) {
                $table->dropColumn('pending_dispo_time');
            });
        }
        if (Schema::hasColumn('performances', 'off_hook_time')) {
            Schema::table('performances', function (Blueprint $table) {
                $table->dropColumn('off_hook_time');
            });
        }
        if (Schema::hasColumn('performances', 'away_time')) {
            Schema::table('performances', function (Blueprint $table) {
                $table->dropColumn('away_time');
            });
        }
        if (Schema::hasColumn('performances', 'training_time')) {
            Schema::table('performances', function (Blueprint $table) {
                $table->dropColumn('training_time');
            });
        }
        if (Schema::hasColumn('performances', 'lunch_time')) {
            Schema::table('performances', function (Blueprint $table) {
                $table->dropColumn('lunch_time');
            });
        }
        if (Schema::hasColumn('performances', 'break_time')) {
            Schema::table('performances', function (Blueprint $table) {
                $table->dropColumn('break_time');
            });
        }
    }
}
