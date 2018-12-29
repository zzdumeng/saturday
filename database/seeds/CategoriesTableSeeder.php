<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Category::truncate();
        (new Faker\Generator)->seed(123);
        $l0 = ['新鲜水果', '生猛海鲜', '肉类家禽', '蛋奶素食', '田园蔬菜',
        '零食酒水', '粮油杂货', '礼品卡券', '家具用品'];
        foreach ($l0 as $c ) {
            # code...
            factory(App\Models\Category::class)->create([
                'level' => 0,
                'name' => $c
            ]);
        }
        $level0 = App\Models\Category::all();
        foreach ($level0 as $l ) {
            factory(App\Models\Category::class, 8)->create([
                'level'=>1,
                'category_id' => $l->id,
            ]);
        }
        $level1 = App\Models\Category::where('level', 1)->get();
        foreach ($level1 as $l1 ) {
            factory(App\Models\Category::class, 15)->create([
                'level'=>2,
                'category_id' => $l1->id,
            ]);
        }
    }
}
