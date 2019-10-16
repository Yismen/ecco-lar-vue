<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 50);
            $table->string('second_first_name', 100)->nullable();
            $table->string('last_name', 50);
            $table->string('second_last_name', 100)->nullable();
            $table->dateTime('hire_date');
            $table->string('personal_id', 15)->nullable()->index();
            $table->string('passport', 100)->nullable()->index();
            $table->dateTime('date_of_birth');
            $table->string('cellphone_number', 25);
            $table->string('secondary_phone', 25)->nullable();

            $table->integer('site_id')->unsigned()->nullable()->index();
            $table->integer('project_id')->unsigned()->nullable()->index();
            $table->integer('position_id')->unsigned()->nullable()->index();
            $table->integer('supervisor_id')->unsigned()->nullable()->index();
            $table->integer('gender_id')->unsigned()->index();
            $table->integer('marital_id')->unsigned()->index();

            $table->integer('ars_id')->unsigned()->nullable();
            $table->integer('afp_id')->unsigned()->nullable();
            $table->integer('nationality_id')->unsigned()->nullable();
            $table->boolean('has_kids', 10)->default(0);
            // $table->integer('kids', 10)->default(0);
            $table->string('photo', 800)->nullable();

            $table->foreign('site_id')->references('id')->on('sites');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->foreign('supervisor_id')->references('id')->on('supervisors');
            $table->foreign('gender_id')->references('id')->on('genders');
            $table->foreign('marital_id')->references('id')->on('maritals');
            $table->foreign('ars_id')->references('id')->on('arss');
            $table->foreign('afp_id')->references('id')->on('afps');

            $table->foreign('nationality_id')->references('id')->on('nationalities');

            $table->timestamps();
        });

        /**
         * set the initial value for the autoincrement field
         */
        if (config('database.default') == 'pgsql') {
            DB::statement('ALTER SEQUENCE employees_id_seq RESTART WITH 10001');
        } elseif (config('database.default') == 'mysql') {
            DB::statement('ALTER TABLE `employees` AUTO_INCREMENT = 10001');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
