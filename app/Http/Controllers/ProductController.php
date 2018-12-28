<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{

    public function reviews() {
        return $this->hasMany('App\Models\Review');
    }

    // public function tags() {
    //     return $this->hasMany('App\Models\Tag');
    // }

    public function show($id)
    {
        $p = Product::find($id);
        return $p;
    }

    public function category()
    {
        // Product::f

    }
}
