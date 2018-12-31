<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSellerOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('orders', function(Blueprint $table) {
            $table->unsignedInteger('seller_id')->nullable();
            $table->foreign('seller_id')->references('id')->on('sellers');
        });
        Schema::table('sellers', function(Blueprint $table) {
            $table->string('corporate')->nullable();
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
        Schema::table('orders', function(Blueprint $table) {
            $table->dropForeign([ 'seller_id' ]);
            $table->dropColumn('seller_id');
        });
        Schema::table('sellers', function(Blueprint $table) {
            $table->dropColumn('corporate');
        });
    }
}
