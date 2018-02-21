<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('contacts', 'username')) {
            Schema::table('contacts', function (Blueprint $table) {
                $table->renameColumn('username', 'user_id');
            });
        }
        if (Schema::hasColumn('contacts', 'user_id')) {
            Schema::table('contacts', function (Blueprint $table) {
                $table->integer('user_id')->unsigned()->nullable()->change();
            });
        }
        if (Schema::hasColumn('contacts', 'public')) {
            Schema::table('contacts', function (Blueprint $table) {
                $table->dropColumn('public');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
        });
    }
}
