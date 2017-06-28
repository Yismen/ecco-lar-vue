<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('messages');
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('sender_id')->unsigned();
            $table->integer('recipient_id')->unsigned();
            $table->string('title', 100);
            $table->string('body', 700)->nullable();
            $table->boolean('read')->nullable()->default(false);

            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('recipient_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('messages');
    }
}
