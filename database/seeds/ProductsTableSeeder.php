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
        factory(App\Models\Product::class, 100)->create();
    }
}
