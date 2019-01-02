<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('digest');
            // $table->double('price');
            $table->json('images')->nullable();
            $table->text('detail')->nullable();
            $table->double('original_price')->nullable();
            $table->double('current_price')->nullable();
            $table->json('specs')->nullable();
            $table->string('unit')->nullable();
            $table->string('pack')->nullable();
            
            $table->boolean('is_friday')->default(false);
            $table->decimal('discount')->default(1.0);
            $table->boolean('is_exchange')->default(false);
            $table->unsignedInteger('redeem_points')->default(0);
            // -1 : 已下架, 失效商品
            // 0: 准备发售
            // 1: 正常销售
            // 2: 缺货
            $table->tinyInteger('status')->default(1);
            // 0: 不定时间
            // 1: 次日达
            // 2: 隔日达
            $table->tinyInteger('delivery')->default(0);

            $table->unsignedInteger('seller_id')->nullable();
            $table->json('category_ids')->nullable();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('name');
            $table->unsignedInteger('level')->default(0);
            $table->unsignedInteger('category_id')->nullable();
        });

        Schema::create('sellers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('name');
            $table->unsignedInteger('level')->default(0);
            $table->text('description');
            $table->text('logo');
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->text('bulletin')->nullable();

            $table->decimal('description_rating')->default(5);
            $table->decimal('product_rating')->default(5);
            $table->decimal('service_rating')->default(5);
            $table->decimal('overall_rating')->default(5);

        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->string('detail', 100);
            $table->string('zipcode');
            $table->string('contact');
            $table->string('mobile');
            $table->string('phone');
            $table->unsignedInteger('province_id')->nullable();
            $table->unsignedInteger('region_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();

            // morph, can be owned by a user or a seller
            $table->unsignedInteger('addressable_id');
            $table->text('addressable_type');
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->text('content');

            $table->unsignedInteger('user_id');
            
        });

        Schema::create('footprints', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('product_id');
            $table->unsignedInteger('user_id');

        });

        // this is the many-to-many table
        Schema::create('favorites', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('product_id');
            $table->unsignedInteger('user_id');

        });

        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('name');
            $table->text('description');
        });

        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('change');
            $table->integer('balance');

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('billtype_id');
        });
        Schema::create('billtypes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('name');
            $table->text('description');
        });
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
           
            # 0 : 普通订单
            # 1 : 积分订单
            $table->unsignedTinyInteger('type');
            // 0 : 待支付
            // 1 : 待发货(已支付)
            // 2 : 待收货
            // 3 :: 待确认
            // 4 :: 交易完成
            // 10 :: 已关闭
            // 11 :: 已取消 
            $table->unsignedTinyInteger('status');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('address_id');
            $table->unsignedInteger('payment_id');
        });
        // Schema::create('carts', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->timestamps();

        //     $table->unsignedInteger('user_id');
        // });
        Schema::create('cartitems', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('quantity');
            $table->unsignedInteger('spec');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('user_id');
        });
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->unsignedInteger('rating');
            $table->text('content');
            $table->json('images');

            $table->unsignedInteger('product_id');
            $table->unsignedInteger('user_id');
        });
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
        });
        Schema::create('tag_product', function (Blueprint $table) {
            $table->increments('id');
            // $table->timestamps();


            $table->unsignedInteger('product_id');
            $table->unsignedInteger('tag_id');
        });
        Schema::create('category_product', function (Blueprint $table) {
            $table->increments('id');
            // $table->timestamps();

            $table->unsignedInteger('product_id');
            $table->unsignedInteger('category_id');
        });
        Schema::create('provinces', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->unsignedInteger('code');
        });
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('name');
            $table->unsignedInteger('code');

            $table->unsignedInteger('province_id');

        });
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('name');
            $table->unsignedInteger('code');
            $table->unsignedInteger('region_id');

        });
        Schema::create('orderitems', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('quantity');
            $table->double('price');

            $table->unsignedInteger('order_id');
            $table->unsignedInteger('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('sellers');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('footprints');
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('bills');
        Schema::dropIfExists('billtypes');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('carts');
        Schema::dropIfExists('cartitems');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('tag_product');
        Schema::dropIfExists('category_product');
        Schema::dropIfExists('provinces');
        Schema::dropIfExists('regions');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('orderitems');
    }
}
