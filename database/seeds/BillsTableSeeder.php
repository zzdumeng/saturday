<?php

use Illuminate\Database\Seeder;

class BillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        App\Models\Bill::truncate();
        (new Faker\Generator)->seed(123);
        $types = App\Models\BillType::all()->toArray();
        $users = App\Models\User::all()->toArray();
        factory(App\Models\Bill::class, 60)->create(
            ['billtype_id' => function() use($types) {
                return array_random($types)['id'];
            },
            'user_id' => function() use($users) {
                return array_random($users)['id'];
            }]
        );
    }
}
