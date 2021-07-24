<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLwUsersCourseModalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lw_users_course_modalities', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('user_id', 250);
            $table->string('course_id', 250);
            $table->unsignedBigInteger('payment_modality_id');
            $table->timestamps();

            
            $table->foreign('payment_modality_id')->references('id')->on('lw_payment_modalities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lw_users_course_modalities');
    }
}
