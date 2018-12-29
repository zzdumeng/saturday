<?php

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Payment::truncate();
        (new Faker\Generator)->seed(123);
        factory(App\Models\Payment::class, 3)->create();
    }
}
