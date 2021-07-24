<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultimediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multimedia', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->integer('order');
            $table->string('path');
            $table->time('duration');
            $table->unsignedBigInteger('type_multimedia_id');
            $table->unsignedBigInteger('multimediable_id');
            $table->string('multimediable_type');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('type_multimedia_id')->references('id')->on('type_multimedia')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multimedia');
    }
}
