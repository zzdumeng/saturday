<?php

use Illuminate\Database\Seeder;

class PointsTableSeeder extends Seeder
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
        $users = App\Models\User::all()->toArray();
        foreach ($users as $user ) {
            for ($i=0; $i < 20; $i++) { 
                
                DB::table('points')->insert([
                    'change'=> mt_rand(10, 1000),
                    'current' => mt_rand(1000, 2000),
                    'source' => $faker->text(15),
                    'user_id' => $user['id'],
                ]);
            }
        }
    }
}
