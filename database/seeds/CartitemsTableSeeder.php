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
        $users = App\Models\User::all()->toArray();
        $ps = App\Models\Product::all()->toArray();
        for ($i=0; $i < 80; $i++) { 
            DB::table('cartitems')
            ->insert(['user_id' => array_random($users)['id'],
            'quantity' => mt_rand(1,6),
            'product_id' => array_random($ps)['id']]);
        }
        // $items = factory(App\Models\CartItem::class, 80)->make([
        //     // [
        //     //     'user_id' => function () use ($users) {
        //     //         return array_random($users)['id'];
        //     //     },
        //     //     'product_id' => function () use ($ps) {
        //     //         return array_random($ps)['id'];
        //     //     },
        //     // ],
        //     ['user_id' => 2,
        //         'product_id' => 2],
        // ]);
        // App\Models\CartItem::insert($items->toArray());
    }
}
