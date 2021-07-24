<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('link');
            $table->string('description');
            $table->integer('order');
            $table->dateTime('schedule');
            $table->unsignedBigInteger('type_live_session_id');
            $table->unsignedBigInteger('chapter_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('type_live_session_id')->references('id')->on('type_live_sessions')->onDelete('cascade');
            $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('live_sessions');
    }
}
