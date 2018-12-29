<?php

use Illuminate\Database\Seeder;

class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Cart::truncate();
        (new Faker\Generator)->seed(123);
        $users = App\Models\User::all()->toArray();
        factory(App\Models\Cart::class, 20)->create(
            ['user_id' => function() use($users) {
                return array_random($users)['id'];
            }]
        );
    }
}
