<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugFieldToLoginNamesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('login_names', function (Blueprint $table) {
            $table->string('slug', 100)->nullable()->after('employee_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (Schema::hasColumn('login_names', 'slug')) {
            Schema::table('login_names', function (Blueprint $table) {
                $table->dropColumn('slug');
            });
        }
        
    }
}
