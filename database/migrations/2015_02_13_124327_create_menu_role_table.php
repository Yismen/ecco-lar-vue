<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_role', function (Blueprint $table) {
            $table->integer('menu_id')->unsigned()->index();
            $table->foreign('menu_id')->references('id')->on('menus')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('role_id')->unsigned()->index();
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menu_role');
    }
}
