<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropShiftsTableIfExists extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::dropIfExists('shifts');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('shifts', function (Blueprint $table) {
        });
    }
}
