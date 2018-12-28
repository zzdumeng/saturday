<?php

use Illuminate\Database\Seeder;
DB::statement("SET foreign_key_checks = 0");
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        (new Faker\Generator)->seed(123);
        // $this->call(ProductsTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        // $this->call(CitiesTableSeeder::class);
    }
}
