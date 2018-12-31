<?php

use Illuminate\Database\Seeder;

class AlterUserTable extends Seeder
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
        App\Models\User::where('id', '>', 0)->each(function($u)use($faker) {
            $u->update(['sex' => array_random([0,1,2]),
            'birthday' =>$faker->dateTimeBetween('-30 years', '-8 years'),
            'avatar' => $faker->imageUrl(128, 128, 'cats')]);
        });
    }
}
