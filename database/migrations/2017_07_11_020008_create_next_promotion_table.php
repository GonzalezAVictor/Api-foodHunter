<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNextPromotionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('next_promotion', function (Blueprint $table) {
            $table->increments('id');
            $table->String('startAt')->nullable();
            $table->String('endAt')->nullable();
            $table->String('promotion_type');
            $table->String('amount_available')->nullable();

            // // //$table->integer('restaurant_id')->unsigned();

            // // //$table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');

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
        //
    }
}