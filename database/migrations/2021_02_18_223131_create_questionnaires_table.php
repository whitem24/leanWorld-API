<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->integer('order');
            $table->unsignedBigInteger('type_questionnaires_id');
            $table->unsignedBigInteger('questionnaireble_id');
            $table->string('questionnaireble_type');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('type_questionnaires_id')->references('id')->on('type_questionnaires')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questionnaires');
    }
}
