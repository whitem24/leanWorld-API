<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('order');
            $table->unsignedBigInteger('questionnaires_id');
            $table->unsignedBigInteger('type_questions_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('questionnaires_id')->references('id')->on('questionnaires')->onDelete('cascade');
            $table->foreign('type_questions_id')->references('id')->on('type_questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
