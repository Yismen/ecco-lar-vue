<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentsToTerminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('terminations', function (Blueprint $table) {
            $table->text('comments')->nullable()->after('can_be_rehired');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('terminations', function (Blueprint $table) {
            $table->dropColumn('comments');
        });
    }
}
