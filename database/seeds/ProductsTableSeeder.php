<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Product::truncate();
        (new Faker\Generator)->seed(123);
        $sellers = App\Models\Seller::all()->toArray();
        factory(App\Models\Product::class, 10000)->create([
            'rating' => $faker->randomFloat(2, 2, 5),
            'sales' => mt_rand(3, 10000),
            'seller_id' => function () use ($sellers) {
                return array_random($sellers)['id'];
            },
        ]);
    }
}
