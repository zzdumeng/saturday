<?php

use Illuminate\Database\Seeder;

class AlterProductsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // DB::table('products')
        // ->all()->update('rating')
        $faker = Faker\Factory::create();
        App\Models\Product::where('id','>', '0')->each(function($p) use($faker){
            $p->update(['rating' => $faker->randomFloat(2,2,5),
            'sales' => mt_rand(3,10000)]);
        });
        // update(['rating' => function() {
        //     return $faker->randomFloat(2, 2,5);
        // }, 
        // 'sales' => function() {
        //     return mt_rand(3, 10000);
        // }]);
    }
}
