<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function show($id) {
        $c = Category::with('parentCategory')->find($id);
        // return var_dump($c->parentCategory);
        return ['parent'=>$c->parentCategory, 'root' => $c->root_category];
    }

    public function __invoke() {
        return Category::with('categories')->where('level', 0)->get();
    }
}
