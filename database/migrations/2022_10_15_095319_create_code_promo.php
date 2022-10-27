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
        Schema::create('code_promo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('promo_id');
            $table->unsignedBigInteger('code_id');
            $table->foreign('promo_id')->references('id')->on('promos');
            $table->foreign('code_id')->references('id')->on('codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('code_promo');
    }
};
