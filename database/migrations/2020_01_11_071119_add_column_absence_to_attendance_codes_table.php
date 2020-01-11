<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAbsenceToAttendanceCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendance_codes', function (Blueprint $table) {
            $table->boolean('absence')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {    
        if (Schema::hasColumn('attendance_codes', 'absence')) {
            Schema::table('attendance_codes', function (Blueprint $table) {
                $table->dropColumn('absence');
            });
        }
    }
}
