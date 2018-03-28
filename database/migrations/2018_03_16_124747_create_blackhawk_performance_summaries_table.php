<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlackhawkPerformanceSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blackhawk_performance_summaries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id')->index()->unique();
            $table->date('date');
            $table->integer('employee_id');
            $table->string('name', 100)->nullable();
            $table->double('time_logged_in', 15, 8);
            $table->double('time_online', 15, 8);
            $table->integer('chat_sessions');
            $table->double('time_in_chats', 15, 8);
            $table->double('max_chat_session_time', 15, 8);
            $table->double('chat_wrap_up_time', 15, 8);
            $table->integer('email_sessions');
            $table->double('time_in_emails', 15, 8);
            $table->double('max_email_session_time', 15, 8);
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
        Schema::dropIfExists('blackhawk_performance_summaries');
    }
}
