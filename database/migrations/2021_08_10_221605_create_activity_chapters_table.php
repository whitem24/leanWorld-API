<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_chapters', function (Blueprint $table) {
            $table->id();
            $table->string('content')->nullable();
            $table->integer('order');
            $table->string('path')->nullable();
            $table->time('duration')->nullable();
            $table->string('link')->nullable();
            $table->dateTime('schedule')->nullable();
            $table->unsignedBigInteger('chapter_id');
            $table->unsignedBigInteger('activity_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('cascade');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_chapters');
    }
}
