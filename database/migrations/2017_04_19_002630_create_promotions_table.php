<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->String('name');
            $table->String('details');
            $table->String('startAt')->nullable();
            $table->String('endAt')->nullable();
            $table->String('promotion_type');
            $table->String('amount_available')->nullable();

            $table->integer('restautante_id')->unsigned();

            // $table->foreign('restautante_id')->references('id')->on('restaurante')->onDelete('cascade');

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
