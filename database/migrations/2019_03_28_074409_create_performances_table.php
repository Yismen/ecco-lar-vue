<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformancesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('performances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id', 100);
            $table->date('date');
            $table->integer('employee_id')->unsigned();
            $table->string('name', 150);
            $table->integer('campaign_id')->unsigned();
            $table->integer('supervisor_id')->unsigned()->nullable();
            $table->double('sph_goal', 15, 8)->nullable()->default(0.00);
            $table->double('login_time', 15, 8)->default(0.00);
            $table->double('production_time', 15, 8)->default(0.00);
            $table->double('talk_time', 15, 8)->default(0.00);
            $table->double('billable_hours', 15, 8)->default(0.00);
            $table->integer('contacts')->unsigned()->default(0);
            $table->integer('calls')->unsigned()->default(0);
            $table->integer('transactions')->unsigned()->default(0);
            $table->double('revenue', 15, 8)->default(0.00);

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('id')->on('supervisors')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('performances');
    }
}
