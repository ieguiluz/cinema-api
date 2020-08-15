<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_schedule', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movie_id');
            $table->foreign('movie_id')->references('id')->on('movies');
            $table->unsignedBigInteger('schedule_id');
            $table->foreign('schedule_id')->references('id')->on('schedules');
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
        Schema::dropIfExists('movie_schedule', function (Blueprint $table) {
            dropForeign(['movie_id', 'schedule_id']);
        });
    }
}
