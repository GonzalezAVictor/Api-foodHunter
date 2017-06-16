<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pasta')->default(0);
            $table->integer('pizza')->default(0);
            $table->integer('hamburguesa')->default(0);
            $table->integer('bebidas')->default(0);
            $table->integer('tacos')->default(0);
            $table->integer('baguettes')->default(0);
            $table->integer('dogos')->default(0);
            $table->integer('mariscos')->default(0);
            $table->integer('postres')->default(0);
            $table->integer('cafe')->default(0);

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('users');
    }
}
