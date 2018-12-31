<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    //
    public function __invoke()
    {
        // find 12 friday product
        $fridays = Product::where('is_friday', true)->limit(12)->get();
        // find 4 prouct for each category:
        // - 水果
        // - 海鲜
        // - 肉类
        // - 蛋奶
        // return Product::where('root_category', '=', '新鲜水果')->limit(3)->get();
        // return Product::where(function ($p) {
        //     return $p->root_category == '新鲜水果';
        // })->limit(3)->get();
        // ->join('category', 'category')
        $p1 = Category::find(1)->first_row;
        $p2 = Category::find(2)->first_row;
        $p3 = Category::find(3)->first_row;
        $p4 = Category::find(4)->first_row;
        // $p1 = Product::where('category_id', '=', '1')
        // // ->limit(4);
        // $p2 = Product::where('category_id', '=', '2')
        //     ->limit(4);
        // $p3 = Product::where('category_id', '=', '3')
        //     ->limit(4);
        // $p4 = Product::where('category_id', '=', '4')
        //     ->limit(4);
        return ['friday' => $fridays,
            'fruit' => $p1,
            'seafood' => $p2,
            'meat' => $p3,
            'milk' => $p4];
    }
}
