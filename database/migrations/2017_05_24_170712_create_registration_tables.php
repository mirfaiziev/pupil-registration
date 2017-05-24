<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('suggest_names');
        Schema::create('suggest_names', function (Blueprint $table) {
            $table->string('name')->unique();
            $table->primary('name');
        });

        Schema::dropIfExists('cities');
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
        });

        Schema::dropIfExists('schools');
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('city_id');
        });

        Schema::dropIfExists('pupils');
        Schema::create('pupils', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip');
            $table->string('first_name');
            $table->string('family_name');
            $table->integer('school_id');
            $table->string('class');
            $table->string('teacher');
            $table->string('phone');
            $table->string('email');
            $table->timestamps();
        });

        Schema::dropIfExists('events');
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('registration_start');
            $table->date('registration_stop');
        });

        Schema::dropIfExists('event_pupil');
        Schema::create('event_pupil', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id');
            $table->integer('pupil_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suggest_names');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('schools');
        Schema::dropIfExists('pupils');
        Schema::dropIfExists('events');
        Schema::dropIfExists('event_pupil');
    }
}
