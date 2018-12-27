<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('province_id');
            $table->unsignedInteger('region_id');
            $table->unsignedInteger('city_id');

            $table->foreign('province_id')->references('id')->on('province');
            $table->foreign('region_id')->references('id')->on('region');
            $table->foreign('city_id')->references('id')->on('city');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}
