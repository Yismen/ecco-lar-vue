<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsCampaignCallsAcceptedAndCallsReroutedToCapillusPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('capillus_daily_performances', function (Blueprint $table) {
            $table->string('campaign', 100)->nullable()->after('date');
            $table->double('calls_accepted', 15, 8)->nullable()->after('campaign');
            $table->double('calls_rerouted', 15, 8)->nullable()->after('calls_accepted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    { 
        if (Schema::hasColumn('capillus_daily_performances', 'campaign')) {
            Schema::table('capillus_daily_performances', function (Blueprint $table) {
                $table->dropColumn('campaign');
            });
        }
        
        if (Schema::hasColumn('capillus_daily_performances', 'calls_accepted')) {
            Schema::table('capillus_daily_performances', function (Blueprint $table) {
                $table->dropColumn('calls_accepted');
            });
        }

        if (Schema::hasColumn('capillus_daily_performances', 'calls_rerouted')) {
            Schema::table('capillus_daily_performances', function (Blueprint $table) {
                $table->dropColumn('calls_rerouted');
            });
        }
    }
}
