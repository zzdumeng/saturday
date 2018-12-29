<?php

use Illuminate\Database\Seeder;

class BilltypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\BillType::truncate();
        (new Faker\Generator)->seed(123);
        factory(App\Models\BillType::class, 3)->create();
    }
}
