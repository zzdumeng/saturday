<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Tag::truncate();
        (new Faker\Generator)->seed(123);
        $ps = App\Models\Product::all()->toArray();
        factory(App\Models\Tag::class, 30)->create()->each(function ($tag) use ($ps) {
            // TODO:
            for ($i = 0; $i < 10; $i++) {
                DB::table('tag_product')
                    ->insert(['product_id' => array_random($ps)['id'],
                        'tag_id' => $tag->id]);
            }
        });
    }
}
