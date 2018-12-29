<?php

use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Review::truncate();
        (new Faker\Generator)->seed(123);
        $ps = App\Models\Product::all();
        $users = App\Models\User::all()->toArray();
        $ps->each(function ($p) use ($users) {
            $p->reviews()->save(
                factory(App\Models\Review::class, mt_rand(3, 50))
                    ->make(['user_id' => function () use ($users) {
                        return array_random($users)['id'];
                    }]));
        });
        // factory(App\Models\Review::class, )
    }
}
