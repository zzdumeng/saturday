<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProductsAddSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('products', function(Blueprint $table) {

            $table->unsignedInteger('sales')->default(0);
            $table->decimal('rating')->default(0);
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

        Schema::table('products', function(Blueprint $table) {
            $table->dropColumn('sales');
            $table->dropColumn('rating');
        });
    }
}
