<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSluggableFieldToPunchesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('punches', function (Blueprint $table) {
            $table->string('slug', 100)->nullable()->after('employee_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('punches', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
