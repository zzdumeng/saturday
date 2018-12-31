<?php

use Illuminate\Database\Seeder;

class AlterOrderTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create();
        $sellers = App\Models\Seller::all()->toArray();

        App\Models\Order::where('id', '>', 0)
        ->each(function($o)use(
            $sellers
        ) {
            $o->update(['seller_id' => array_random($sellers)['id']]);
        });
    }
}
