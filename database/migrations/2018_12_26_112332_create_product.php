<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title');
            $table->string('description');
            // $table->double('price');
            $table->json('images')->nullable();
            $table->text('detail')->nullable();
            $table->double('originalPrice')->nullable();
            $table->double('currentPrice')->nullable();
            $table->json('specs')->nullable();
            
            $table->unsignedInteger('seller_id');
            // $table->foreign('reviews')->references('id')->on('review');
            $table->foreign('seller_id')->references('id')->on('seller');

            // many-to-many
            // should create a new table

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
