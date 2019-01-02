<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\User::truncate();
        (new Faker\Generator)->seed(123);
        factory(App\Models\User::class, 10)->create()->each(function($user){
            $user->messages()->saveMany(factory(App\Models\Message::class, 5)->make());
        });
    }
}
