<?php

use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        App\Models\Address::truncate();
        (new Faker\Generator)->seed(123);
        $users = App\Models\User::all()->toArray();

        factory(App\Models\Address::class, 200)->create(
            ['addressable_type' => 'user',
            'addressable_id' => function() use($users) {
                srand();
                return $users[array_rand($users)]['id'];
            }]
        );
    }
}
