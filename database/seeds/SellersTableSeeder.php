<?php

use Illuminate\Database\Seeder;

class SellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Seller::truncate();
        // (new Faker\Generator)->seed(123);
        // $users = App\Models\User::all()->toArray();

        factory(App\Models\Seller::class, 100)->create(
        );
        // create 100 more addresses
        $x = 0;
        $sellers = App\Models\Seller::all()->toArray();
        factory(App\Models\Address::class, 100)->create(
            ['addressable_type' => 'seller',
            'addressable_id' => function() use($sellers, $x) {
                return $sellers[$x++]['id'];
            }]
        );

    }
}
