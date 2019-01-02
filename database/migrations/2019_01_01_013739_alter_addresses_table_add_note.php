<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAddressesTableAddNote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('note')->nullable();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('default_address');
            $table->foreign('default_address')->references('id')->on('addresses');
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
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('note');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('default_address');
        });
    }
}
