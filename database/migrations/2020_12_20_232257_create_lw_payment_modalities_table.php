<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLwPaymentModalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lw_payment_modalities', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->float('company_percent');
            $table->float('instructor_percent');
            $table->float('affiliate_percent')->nullable();
            

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lw_payment_modalities');
    }
}
