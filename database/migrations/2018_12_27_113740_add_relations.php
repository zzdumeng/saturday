<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // product
        Schema::table('products', function (Blueprint $table) {
            $table->index('seller_id');
            $table->foreign('seller_id')->references('id')->on('sellers');
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->index('addressable_id');

            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('city_id')->references('id')->on('cities');
            // $table->foreign('user_id')->references('id')->on('users');

        });

        Schema::table('categories', function (Blueprint $table) {
            $table->index('level');
            $table->index('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('footprints', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('created_at');

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('bills', function (Blueprint $table) {
            $table->index('user_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('billtype_id')->references('id')->on('billtypes');
        });

        // Schema::table('carts', function (Blueprint $table) {
        //     // $table->index('user_id');

        //     $table->foreign('user_id')->references('id')->on('users');
        // });

        Schema::table('cartitems', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('product_id');

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('address_id')->references('id')->on('addresses');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('product_id');

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('tag_product', function (Blueprint $table) {
            $table->index('product_id');
            $table->index('tag_id');

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('tag_id')->references('id')->on('tags');
        });

        Schema::table('category_product', function (Blueprint $table) {
            $table->index('product_id');
            $table->index('category_id');

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::table('regions', function (Blueprint $table) {
            $table->index('province_id');
            $table->foreign('province_id')->references('id')->on('provinces');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->index('region_id');
            $table->foreign('region_id')->references('id')->on('regions');
        });

        Schema::table('orderitems', function (Blueprint $table) {
            $table->index('order_id');

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['seller_id']);
            $table->dropIndex(['seller_id']);
        });
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropIndex(['addressable_id']);
            // $table->dropForeign(['user_id']);
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropIndex(['user_id']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign([ 'category_id' ]);
            $table->dropIndex([ 'level' ]);
            // $table->foreign('user_id')->references('id')->on('users');
            $table->dropIndex([ 'category_id' ]);
        });
        Schema::table('footprints', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['user_id']);
            $table->dropIndex(['user_id']);
            $table->dropIndex(['created_at']);

        });

        Schema::table('bills', function (Blueprint $table) {
            $table->dropForeign(['billtype_id']);
            $table->dropForeign(['user_id']);
            $table->dropIndex(['user_id']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['payment_id']);
            $table->dropForeign(['address_id']);

            $table->dropIndex(['user_id']);

        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['user_id']);
            $table->dropIndex(['user_id']);
            $table->dropIndex(['product_id']);

        });
        Schema::table('tag_product', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['tag_id']);
            $table->dropIndex(['product_id']);
            $table->dropIndex(['tag_id']);

        });

        Schema::table('regions', function (Blueprint $table) {
            $table->dropForeign(['province_id']);
            $table->dropIndex(['province_id']);
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
            $table->dropIndex(['region_id']);
        });

        Schema::table('orderitems', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropForeign(['product_id']);
            $table->dropIndex(['order_id']);

        });

        // Schema::table('carts', function (Blueprint $table) {
        //     $table->dropForeign(['user_id']);
        // });

        Schema::table('cartitems', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['product_id']);

            $table->dropIndex(['user_id']);
            $table->dropIndex(['product_id']);

        });

        Schema::table('category_product', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['category_id']);
            $table->dropIndex(['product_id']);
            $table->dropIndex(['category_id']);

        });
        Schema::table('favorites', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['product_id']);
            $table->dropIndex(['user_id']);
            $table->dropIndex(['product_id']);
        });
    }
}
