<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMessagesAddStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('messages', function (Blueprint $table) {
            # 0 : 未查看
            # 1 : 已查看
            $table->tinyInteger('status')->default(0);
            $table->string('title');
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
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('title');
        });
    }
}
