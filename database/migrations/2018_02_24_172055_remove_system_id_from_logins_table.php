<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveSystemIdFromLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('logins', 'system_id')) {
            Schema::disableForeignKeyConstraints();
            Schema::table('logins', function (Blueprint $table) {
                // $table->dropForeign('logins_ibfk_2');
                $table->dropColumn('system_id');
            });

            Schema::enableForeignKeyConstraints();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('logins', function (Blueprint $table) {
            //
        });
    }
}
