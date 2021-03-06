<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\City::truncate();
        $regions = App\Models\Region::all()->toArray();
        factory(App\Models\City::class, 500)->create([
            'region_id' => function () use ($regions) {return array_random($regions)['id'];},
        ]);
        // for ($i = 0; $i < 1000; $i++) {
        //     # code...
        //     try {

        //         factory(App\Models\City::class)->create([
        //             'region_id' => array_random($regions)->id,
        //         ]);
        //     } catch (Exception $ex) {
        //         echo 'city: error';
        //     }
        // }
    }
}
