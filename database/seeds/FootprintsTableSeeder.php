<?php

use Illuminate\Database\Seeder;

class FootprintsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Footprint::truncate();
        (new Faker\Generator)->seed(123);
        $ps = App\Models\Product::all()->toArray();
        $users = App\Models\User::all()->toArray();
        factory(App\Models\Footprint::class, 300)->create(
            ['product_id' => function () use ($ps) {
                return array_random($ps)['id'];
            },
                'user_id' => function () use ($users) {
                    return array_random($users)['id'];
                }]
        );
    }
}
