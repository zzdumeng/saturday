<?php

use Illuminate\Database\Seeder;

class CategoryProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // App\Models\CategoryProduct::truncate();
        DB::table('category_product')->truncate();
        (new Faker\Generator)->seed(123);
        $cs = App\Models\Category::all()->toArray();
        $ps = App\Models\Product::all()->toArray();
        foreach ($ps as $p) {
            DB::table('category_product')
                ->insert([
                    'product_id' => $p['id'],
                    'category_id' =>array_random($cs)['id'] ,               ]);
        }
        // factory(App\Models\CategoryProduct::class, 30)->create(
        //     ['category_id' => function () use ($cs) {
        //         return array_random($cs)['id'];
        //     },
        //         'product_id' => function () use ($ps) {
        //             return array_random($ps)['id'];
        //         }]
        // );
    }
}
