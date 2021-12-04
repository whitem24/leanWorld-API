<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            // $table->string("username");
            $table->string("fname")->nullable();
            $table->string("lname")->nullable();
            $table->string("email");
            $table->string("orgname")->nullable();
            $table->string("location")->nullable();
            $table->string("imagelink")->nullable();
            $table->string("phone_no")->nullable();
            $table->unsignedBigInteger("userid");
            $table->timestamps();
            
            // Foreign references
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
