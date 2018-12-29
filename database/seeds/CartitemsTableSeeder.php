<?php

use Illuminate\Database\Seeder;

class CartItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\CartItem::truncate();
        (new Faker\Generator)->seed(123);
        $carts = App\Models\Cart::all()->toArray();
        $ps = App\Models\Product::all()->toArray();
        factory(App\Models\CartItem::class, 30)->create([
            ['cart_id' => function () use ($carts) {
                return array_random($carts)['id'];
            },
                'product_id' => function () use ($ps) {
                    return array_random($ps)['id'];
                },
            ],
        ]);
    }
}
