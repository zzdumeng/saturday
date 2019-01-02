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
        // $this->call(ProvincesTableSeeder::class);
        // $this->call(RegionsTableSeeder::class);
        // $this->call(CitiesTableSeeder::class);

        // $this->call(UsersTableSeeder::class);
        // $this->call(AddressesTableSeeder::class);
        // $this->call(SellersTableSeeder::class);
        // $this->call(ProductsTableSeeder::class);
        // $this->call(CategoriesTableSeeder::class);


        // $this->call(PaymentsTableSeeder::class);
        // $this->call(BilltypesTableSeeder::class);
        // $this->call(BillsTableSeeder::class);

        // $this->call(CartItemsTableSeeder::class);

        // $this->call(CategoryProductTableSeeder::class);

        // $this->call(FavoritesTableSeeder::class);
        // $this->call(FootprintsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(TagsTableSeeder::class);


    }
}
