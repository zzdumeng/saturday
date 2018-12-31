<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
 */

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'mobile' => $faker->phoneNumber(),
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Models\Cart::class, function (Faker $faker) {
    return [
        'user_id' => 1,
    ];
});
$factory->define(App\Models\CartItem::class, function (Faker $faker) {
    return [
        'quantity' => mt_rand(2, 10),
        'product_id' => 1,
        'cart_id' => 1,
    ];
});
$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3),
        'digest' => $faker->sentence(5),
        'images' => [$faker->imageUrl(200, 200), $faker->imageUrl(200, 200), $faker->imageUrl(200, 200),
            $faker->imageUrl(200, 200)],
        'detail' => $faker->text(400),
        'original_price' => $faker->randomFloat(2, 40, 60),
        'current_price' => $faker->randomFloat(2, 20, 40),
        'specs' => [mt_rand(10, 100), mt_rand(100, 200),
            mt_rand(200, 500)],
        'unit' => array_random(['克', '个', '只', '条']),
        'pack' => array_random(['箱', '袋', '包']),
        'is_friday' => array_random([true, false]),
        'discount' => $faker->randomFloat(2, 0.6, 0.8),
        'is_exchange' => array_random([true, false]),
        'redeem_points' => mt_rand(500, 10000),
        'status' => array_random([-1, 0, 1, 2]),
        'delivery' => array_random([0, 1, 2]),

        'seller_id' => 1,
    ];
});

$factory->define(App\Models\Address::class, function (Faker $faker) {
    return [
        'detail' => $faker->text(20),
        'zipcode' => $faker->postcode(),
        'contact' => $faker->name(),
        'mobile' => $faker->phoneNumber(),
        'phone' => $faker->e164PhoneNumber(),
        'province_id' => 1,
        'region_id' => 1,
        'city_id' => 1,
    ];
});

$factory->define(App\Models\Bill::class, function (Faker $faker) {
    return [
        'change' => mt_rand(10, 100),
        'balance' => mt_rand(1000, 2000),
        'billtype_id' => 1,
        'user_id' => 1,
    ];
});
$factory->define(App\Models\BillType::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'description' => $faker->text(100),
    ];
});
$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'level' => array_random([0, 1, 2]),
    ];
});
$factory->define(App\Models\City::class, function (Faker $faker) {
    return [
        'name' => $faker->area(),
        'code' => random_int(10000, 90000),
        'region_id' => 1,
    ];
});
$factory->define(App\Models\Footprint::class, function (Faker $faker) {
    return [
        'product_id' => 1,
        'user_id' => 1,
    ];
});
$factory->define(App\Models\Message::class, function (Faker $faker) {
    return [
        'content' => $faker->text(200),
        'user_id' => 1,
    ];
});
$factory->define(App\Models\Order::class, function (Faker $faker) {
    return [
        'status' => array_random([0, 1, 2, 3, 4, 10, 11]),
        'user_id' => 1,
        'payment_id' => 1,
    ];
});
$factory->define(App\Models\OrderItem::class, function (Faker $faker) {
    return [
        'quantity' => random_int(1, 10),
        'price' => $faker->randomFloat(2, 20, 100),
        'product_id' => 1,
        'order_id' => 1,
    ];
});
$factory->define(App\Models\Payment::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'description' => $faker->text(50),
    ];
});
$factory->define(App\Models\Province::class, function (Faker $faker) {
    return [
        'name' => $faker->state(),
        'code' => random_int(100, 999),
    ];
});
$factory->define(App\Models\Region::class, function (Faker $faker) {

    return [
        'name' => $faker->city(),
        'code' => random_int(1000, 9000),
        'province_id' => 1,
    ];
});
$factory->define(App\Models\Review::class, function (Faker $faker) {
    return [
        'rating' => mt_rand(1, 5),
        'content' => $faker->text(200),
        'images' => array_map(function ()use($faker) {
            return $faker->imageUrl(200, 200);
        }, [1, 2, 3]),
        'product_id' => 1,
        'user_id' => 1,
    ];
});
$factory->define(App\Models\Seller::class, function (Faker $faker) {
    return [
        'name' => $faker->company(),
        'level' => mt_rand(0, 10),
        'description' => $faker->text(400),
        'logo' => $faker->imageUrl(200, 200),
        'mobile' => $faker->phoneNumber(),
        'phone' => $faker->e164PhoneNumber(),
        'bulletin' => $faker->text(100),
        'description_rating' => $faker->randomFloat(2, 3, 5),
        'product_rating' => $faker->randomFloat(2, 3, 5),
        'service_rating' => $faker->randomFloat(2, 3, 5),
        'overall_rating' => $faker->randomFloat(2, 3, 5),

    ];
});
$factory->define(App\Models\Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
    ];
});

// $factory->define(App\Models\Tag::class, function (Faker $faker) {
//     return [
//         'name' => $faker->word(),
//     ];
// });
