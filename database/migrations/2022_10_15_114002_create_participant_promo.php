<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_promo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('promo_id');
            $table->unsignedBigInteger('participant_id');
            $table->foreign('promo_id')->references('id')->on('promos');
            $table->foreign('participant_id')->references('id')->on('participants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participant_promo');
    }
};
