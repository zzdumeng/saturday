<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Order::truncate();
        (new Faker\Generator)->seed(123);
        $users = App\Models\User::all()->toArray();
        $ps = App\Models\Product::all()->toArray();
        $pays = App\Models\Payment::all()->toArray();
        factory(App\Models\Order::class, 30)->create([
            'user_id' => function () use ($users) {
                return array_random($users)['id'];
            },
            'payment_id' => function () use ($pays) {
                return array_random($pays)['id'];
            },
        ])->each(function ($order) use($ps){
            $order->items()->saveMany(factory(App\Models\OrderItem::class, 3)->create(
                ['product_id' => function () use ($ps) {
                    return array_random($ps)['id'];
                }]
            ));
        });
    }
}
