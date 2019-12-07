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
            $table->double('transfer_bulk_order', 15, 8)->nullable()->after('transfer_physician_doctor');
            
            $table->dropUnique('capillus_daily_performances_date_unique');
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

        if (Schema::hasColumn('capillus_daily_performances', 'transfer_bulk_order')) {
            Schema::table('capillus_daily_performances', function (Blueprint $table) {
                $table->dropColumn('transfer_bulk_order');
            });
        }
        
        if (Schema::hasColumn('capillus_daily_performances', 'date')) {
            Schema::table('capillus_daily_performances', function (Blueprint $table) {
                $table->unique('date');
            });
        }
    }
}
