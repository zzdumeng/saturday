<?php

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        App\Models\Province::truncate();
        factory(App\Models\Province::class, 10)->create();
        // for ($i = 0; $i < 20; $i++) {
        //     # code...
        //     try {
        //         factory(App\Models\Province::class)->create();
        //     } catch (Exception $e) {
        //         echo 'something error when create province;'.$e->getMessage();
        //     }}
        // try{
        //     factory(App\Models\Province::class, 20)->create();
        // } catch (Exception $e) {
        //     echo 'something error when create province';
        // }
    }
}
