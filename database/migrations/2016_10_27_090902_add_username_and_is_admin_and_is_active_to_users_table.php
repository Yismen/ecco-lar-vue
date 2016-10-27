<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsernameAndIsAdminAndIsActiveToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 100)->nullable()->index();
            $table->boolean('is_active')->nullable()->default(false);
            $table->boolean('is_admin')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('username');
            $table->dropColumn('username');
            $table->dropColumn('is_active');
            $table->dropColumn('is_admin');
        });
    }
}
