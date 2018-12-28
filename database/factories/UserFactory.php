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
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'digest' => str_random(10),
        'images' => $faker->imageUrl(200,200),
        'detail' => $faker->text(400),
        'seller_id' => 1,
    ];
});

$factory->define(App\Models\Address::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'digest' => str_random(10),
        'images' => $faker->imageUrl(200,200),
        'detail' => $faker->text(400),
        'seller_id' => 1,
    ];
});

$factory->define(App\Models\Bill::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'digest' => str_random(10),
        'images' => $faker->imageUrl(200,200),
        'detail' => $faker->text(400),
        'seller_id' => 1,
    ];
});
$factory->define(App\Models\BillType::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'digest' => str_random(10),
        'images' => $faker->imageUrl(200,200),
        'detail' => $faker->text(400),
        'seller_id' => 1,
    ];
});
$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'digest' => str_random(10),
        'images' => $faker->imageUrl(200,200),
        'detail' => $faker->text(400),
        'seller_id' => 1,
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
        'name' => $faker->firstName,
        'digest' => str_random(10),
        'images' => $faker->imageUrl(200,200),
        'detail' => $faker->text(400),
        'seller_id' => 1,
    ];
});
$factory->define(App\Models\Message::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'digest' => str_random(10),
        'images' => $faker->imageUrl(200,200),
        'detail' => $faker->text(400),
        'seller_id' => 1,
    ];
});
$factory->define(App\Models\Order::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'digest' => str_random(10),
        'images' => $faker->imageUrl(200,200),
        'detail' => $faker->text(400),
        'seller_id' => 1,
    ];
});
$factory->define(App\Models\OrderItem::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'digest' => str_random(10),
        'images' => $faker->imageUrl(200,200),
        'detail' => $faker->text(400),
        'seller_id' => 1,
    ];
});
$factory->define(App\Models\Payment::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'digest' => str_random(10),
        'images' => $faker->imageUrl(200,200),
        'detail' => $faker->text(400),
        'seller_id' => 1,
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
        'name' => $faker->firstName,
        'digest' => str_random(10),
        'images' => $faker->imageUrl(200,200),
        'detail' => $faker->text(400),
        'seller_id' => 1,
    ];
});
$factory->define(App\Models\Seller::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'digest' => str_random(10),
        'images' => $faker->imageUrl(200,200),
        'detail' => $faker->text(400),
        'seller_id' => 1,
    ];
});
$factory->define(App\Models\Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'digest' => str_random(10),
        'images' => $faker->imageUrl(200,200),
        'detail' => $faker->text(400),
        'seller_id' => 1,
    ];
});