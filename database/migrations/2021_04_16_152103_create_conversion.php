<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coin_id');
            $table->foreign('coin_id')->references('id')->on('coins');
            $table->unsignedBigInteger('coin_conversion_id');
            $table->foreign('coin_conversion_id')->references('id')->on('coins');
            $table->double('value_conversion');
            $table->double('price_conversion')->nullable();
            $table->foreignId('user_id')->constrained()->nullable();
            $table->date('date_conversion')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversions');
    }
}
