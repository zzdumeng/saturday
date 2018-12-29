<?php

use Illuminate\Database\Seeder;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // App\Models\Bills::truncate();
        // (new Faker\Generator)->seed(123);
        // factory(App\Models\Bills::class, 30)->create();
        $users = App\Models\User::all()->toArray();
        $products = App\Models\Product::all()->toArray();
        for ($i = 0; $i < 1000; $i++) {

            DB::table('favorites')->insert([
                'user_id' => function () use ($users) {
                    return array_random($users)['id'];
                },
                'product_id' => function () use ($products) {
                    return array_random($products)['id'];
                },
            ]);
        }
    }
}
