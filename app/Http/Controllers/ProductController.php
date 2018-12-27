<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
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
