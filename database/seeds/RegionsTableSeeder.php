<?php

use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Region::truncate();
        $provinces = App\Models\Province::all()->toArray();
        var_dump($provinces);

        var_dump(array_rand($provinces));
        factory(App\Models\Region::class, 100)->create(
            ['province_id' => function () use($provinces) {
                srand();
                return $provinces[array_rand($provinces)]['id'];
            }]
        );
        // for ($i=0; $i < 100; $i++) {
        //     try{

        //         factory(App\Models\Region::class, 100)->create(
        //             ['province_id' => array_random($provinces)->id]
        //         );
        //     }catch(Exception $ex) {
        //         echo 'region: error'. $ex->message;
        //     }
        // }

    }
}
